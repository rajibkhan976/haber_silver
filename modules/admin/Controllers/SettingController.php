<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 11/25/16
 * Time: 2:07 PM
 */

namespace Modules\Admin\Controllers;

use App\Http\Helpers\ActivityLogs;
use Modules\Admin\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Modules\User\Models\UserActivity;
use App\Helpers\UserLogFileHelper;

class SettingController extends Controller
{

    //Get and Post method
    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting_type = Input::get('type');
        $pageTitle = "List of Setting Information";
        $data = Settings::where('type', 'LIKE', '%'.$setting_type.'%')->paginate(30);


        // drop-down - lists
        $setting_lists = DB::table('settings')->where('settings.status', '!=', 'cancel')
                ->select('id', 'type')->get();

        //set data
        $action_name = 'Settings Index Page ';
        $action_url = 'admin/setting';
        $action_detail = @\Auth::user()->username.' '. 'view Settings :: Index ';
        $action_table = 'settings';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::setting.index',[
            'data'=>$data,
            'pageTitle'=>$pageTitle,
            'setting_lists'=>$setting_lists,
        ]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_setting()
    {

        $pageTitle = 'Settings Information';
        $model = new Settings();

        if($this->isGetRequest())
        {
            $type = Input::get('type');
            $model = $model->where('type', 'LIKE', '%'.$type.'%');
            $model = $model->orWhere('status', 'LIKE', '%'.$type.'%');
            $data = $model->paginate(30);

        }else{
            $data = Settings::where('status', '!=', 'cancel')->paginate(30);
        }
           
        //set user activity data
        $action_name = 'search settings';
        $action_url = 'admin/search-setting';
        $action_detail = @\Auth::user()->username.' '. 'search role by :: '.Input::get('title');
        $action_table = 'settings';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::setting.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
            ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_setting(Requests\SettingRequest $request)
    {

        $input = $request->all();

        $data= Settings::where('type', '=', $input['type'])->get();

        if( count($data) <=0)
        {        
            //$input['slug'] = str_slug(strtolower($input['title']));
            $input_data = [
                    'type'=> $input['type'],
                    'last_number'=> $input['last_number'],
                    'increment'=> $input['increment'],
                    'status'  => $input['status'],
                    'updated_by'=> 0,
                ];

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                if(Settings::create($input_data))
                {
                    //set user activity data
                    $action_name = 'create a settings';
                    $action_url = 'admin/store-setting';
                    $action_detail = @\Auth::user()->username.' '. 'create a role :: '.@$input['title'];
                    $action_table = 'settings';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                UserLogFileHelper::log_info('store-setting', 'Successfully Added', ['Role Title '.$input_data['type']]);
                Session::flash('message', 'Successfully added!');
                
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                UserLogFileHelper::log_error('store-setting', $e->getMessage(), ['Role Title '.$input_data['type']]);
                Session::flash('danger', $e->getMessage());
          
            }


        }else{
            Session::flash('info', 'This setting already added!');

        }
        return redirect()->back();


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = 'View Settings Informations';
        $data = Settings::where('id',$id)->first();


        //set user activity data
        $action_name = 'View settings';
        $action_url = 'admin/show-setting';
        $action_detail = @\Auth::user()->username.' '. 'view settings by :: '.@$data->type;
        $action_table = 'settings';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::setting.show', ['data' => $data, 'pageTitle'=> $pageTitle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Settings Informations";              
        $data = Settings::where('id',$id)->first();


        //set user activity data
        $action_name = 'Edit settings';
        $action_url = 'admin/edit-setting';
        $action_detail = @\Auth::user()->username.' '. 'edit settings by :: '.@$data->type;
        $action_table = 'settings';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::setting.edit', [
            'data' => $data,
            'pageTitle'=> $pageTitle
        ]);
                   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\SettingRequest $request, $id)
    {
        $input = $request->all();

         $type = $input['type'];
         $dataquery = Settings::where('id',$id)->first();

         $statusquery = DB::table('settings')->select('status')->where('id',$id)->first();

         if(!isset($statusquery)){

              if( count($dataquery) <=0)
              {

                    $model = Settings::where('type',$type)->first();
                    DB::beginTransaction();
                    try {
                        $model->update($input);
                        DB::commit();
                        UserLogFileHelper::log_info('update-setting', 'Successfully updated.', ['Settings Type '.$input['type']]);
                        Session::flash('message', 'Successfully added!');


                    }catch (\Exception $e) {
                        //If there are any exceptions, rollback the transaction`
                        DB::rollback();
                        UserLogFileHelper::log_error('update-setting', $e->getMessage(), ['Settings Type '.$input['Type']]);
                        Session::flash('danger', $e->getMessage());
                    }

              }else{
                    Session::flash('info', 'This role already added!');
              }

        }else{

            $model = Settings::where('id',$id)->first();
            DB::beginTransaction();
            try {
                $model->update($input);
                DB::commit();
                Session::flash('message', 'Successfully added!');

            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }

        }

        //set user activity data
        $action_name = 'Update settingd';
        $action_url = 'admin/update-setting';
        $action_detail = @\Auth::user()->username.' '. 'update settings by :: '.@$input['type'];
        $action_table = 'roles';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id != null){
            $model = Settings::where('id',$id)->first();
            DB::beginTransaction();
            try {
                if($model->status =='active'){
                    $model->status = 'cancel';
                }else{
                    $model->status = 'active';
                }

                if($model->save())
                {
                    //set data
                    $action_name = 'cancel the settings';
                    $action_url = 'admin/delete-setting';
                    $action_detail = @\Auth::user()->username.' '. 'create a settings :: '.$model->type;
                    $action_table = 'settings';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                }

                DB::commit();
                UserLogFileHelper::log_info('delete-setting', "Successfully Deleted.", ['Settings Type '.$model->type]);
                Session::flash('message', "Successfully Deleted.");


            } catch(\Exception $e) {
                DB::rollback();
                UserLogFileHelper::log_error('delete-setting', $e->getMessage(), ['Settings Type '.$model->type]);
                Session::flash('danger',$e->getMessage());

            }
        }

        return redirect()->back();
    }

}