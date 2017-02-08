<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 11/25/16
 * Time: 2:07 PM
 */

namespace Modules\Admin\Controllers;

use App\Helpers\AdminLogFileHelper;
use App\Http\Helpers\ActivityLogs;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Models\MenuPanel;
use Modules\User\Models\UserActivity;
use App\Helpers\UserLogFileHelper;

class MenuPanelController extends Controller
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
        $menu_title = Input::get('title');
        $pageTitle = "List of Menu";
        $data = MenuPanel::where('menu_type', 'LIKE', '%'.$menu_title.'%')
                            ->orWhere('menu_name', 'LIKE', '%'.$menu_title.'%')
                            ->orWhere('status', 'LIKE', '%'.$menu_title.'%')->paginate(30);
        //  drop-down-lists for add menu
        $menu_lists = DB::table('menu_panel')->select('id','menu_type','menu_name')->orderBy('menu_type')->get();

        //set data
        $action_name = 'Menu Panel Index Page ';
        $action_url = 'admin/menu-panel';
        $action_detail = @\Auth::user()->username.' '. 'view menu panel :: Index ';
        $action_table = 'menu_panel';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
        return view('admin::menu_panel.index',[
            'data'=>$data,
            'pageTitle'=>$pageTitle,
            'menu_lists'=>$menu_lists,
        ]);
    }


    public function show($id){

        $pageTitle = "Menu Details";
        $data = MenuPanel::where('id', $id)->first();
                $parent_id= $data->parent_menu_id;
        $parent = MenuPanel::where('id', $parent_id)->first();

        //set data
        $action_name = 'View menu panel details Page ';
        $action_url = 'admin/view-menu-panel';
        $action_detail = @\Auth::user()->username.' '. 'view menu panel :: details ';
        $action_table = 'menu_panel';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::menu_panel.view',[
            'data'=>$data,
            'pageTitle'=>$pageTitle,
            'parent'=>$parent,

        ]);

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {

        $pageTitle = 'Menu Panel Information';
        $model = new MenuPanel();

            $title = Input::get('title');
            $model = $model->where('menu_type', 'LIKE', '%'.$title.'%');
            $model = $model->orWhere('menu_name', 'LIKE', '%'.$title.'%');
            $model = $model->orWhere('route', 'LIKE', '%'.$title.'%');
            $model = $model->orWhere('icon_code', 'LIKE', '%'.$title.'%');
            $model = $model->orWhere('status', 'LIKE', '%'.$title.'%');
            $data = $model->paginate(30);
        //set user activity data
        $action_name = 'search menu panel';
        $action_url = 'admin/search-menu-panel';
        $action_detail = @\Auth::user()->username.' '. 'search menu panel  by :: '.Input::get('title');
        $action_table = 'menu_panel';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::menu_panel.index',[
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
    public function store_menu_panel(Requests\MenuPanelRequest $request)
    {
        $input = $request->all();

       $aa=DB::table('menu_panel')->get()->count();
       $input['menu_id']=$aa+1;



        $menu_name=$input['menu_name'];
        $data = DB::table('menu_panel')->select('menu_name')->where('menu_name',$menu_name)->count();

        if( $data <=0)
        {
            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                if(MenuPanel::create($input))
                {
                    //set user activity data
                    $action_name = 'create a settings';
                    $action_url = 'admin/store-setting';
                    $action_detail = @\Auth::user()->username.' '. 'create a menu :: '.@$input['menu_name'];
                    $action_table = 'settings';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                AdminLogFileHelper::log_info('store-setting', 'Successfully Added', ['Setting Title '.$input['menu_name']]);
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('store-setting', $e->getMessage(), ['Setting Title '.$input['menu_name']]);
                Session::flash('danger', $e->getMessage());

            }


        }else{
            Session::flash('info', 'This Menu already added!');

        }
        return redirect()->back();


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Edit of Menu Panel";
        $data = MenuPanel::where('id', $id)->first();
        $menu_lists = DB::table('menu_panel')->select('id','menu_type','menu_name')->orderBy('menu_type')->get();
        $edit_cons = 'edit';


        //set user activity data
        $action_name = 'Edit menu panel';
        $action_url = 'admin/edit-menu-panel/{id}';
        $action_detail = @\Auth::user()->username.' '. 'edit menu panel by :: '.@$data->menu_name;
        $action_table = 'menu_panel';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::menu_panel.update', [
            'data'=>$data,
            'pageTitle'=>$pageTitle,
            'menu_lists'=>$menu_lists,
            'edit_cons' => $edit_cons,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\MenuPanelRequest $request, $id)
    {
        $input = $request->all();

        $input_menu=$input['menu_name'];
        $query_menu= DB::table('menu_panel')->select('menu_name')->where('id','=',$id)->first();
        $old_menu= $query_menu->menu_name;
        if( $input_menu == $old_menu){
                    $model = MenuPanel::where('id',$id)->first();
                    $model->menu_type = $input['menu_type'];
                    $model->menu_name = $input['menu_name'];
                    $model->route = $input['route'];
                    $model->parent_menu_id = $input['parent_menu_id'];
                    $model->icon_code = $input['icon_code'];
                    $model->menu_order = $input['menu_order'];
                    $model->status = $input['status'];

                    DB::beginTransaction();
                    try {
                        $model->update();
                        DB::commit();
                        AdminLogFileHelper::log_info('update-setting', 'Successfully updated.', ['Menu Name '.$input['menu_name']]);
                        Session::flash('message', 'Successfully updated!');

                    }catch (\Exception $e) {
                        //If there are any exceptions, rollback the transaction`
                        DB::rollback();
                        AdminLogFileHelper::log_error('update-setting', $e->getMessage(), ['Menu Name '.$input['menu_name']]);
                        Session::flash('danger', $e->getMessage());
                    }
        }else{
                $data = DB::table('menu_panel')->select('menu_name')->where('menu_name',$input_menu)->count();
                if( $data <=0){
                    $model = MenuPanel::where('id',$id)->first();

                    $model->menu_type = $input['menu_type'];
                    $model->menu_name = $input['menu_name'];
                    $model->route = $input['route'];
                    $model->parent_menu_id = $input['parent_menu_id'];
                    $model->icon_code = $input['icon_code'];
                    $model->menu_order = $input['menu_order'];
                    $model->status = $input['status'];


                    DB::beginTransaction();
                    try {
                        $model->update();
                        DB::commit();
                        AdminLogFileHelper::log_info('update-setting', 'Successfully updated.', ['Settings Type '.$input['menu_name']]);
                        Session::flash('message', 'Successfully Updated!');


                    }catch (\Exception $e) {
                        //If there are any exceptions, rollback the transaction`
                        DB::rollback();
                        AdminLogFileHelper::log_error('update-setting', $e->getMessage(), ['Settings Type ' . $input['menu_name']]);

                    }

                }else{
                    Session::flash('info', 'This Menu already added!');

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id != null) {
            $data = MenuPanel::where('id', $id)->first();
            DB::beginTransaction();
            try {
                if ($data->status == 'active') {
                    $data->status = 'cancel';
                } else {
                    $data->status = 'active';
                }

                if ($data->save()) {
                    //set data
                    $action_name = 'cancel the menu';
                    $action_url = 'admin/delete-menu-panel';
                    $action_detail = @\Auth::user()->username . ' ' . 'delete menu-panel , Menu Name :: ' . $data->menu_name;
                    $action_table = 'menu_panel';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                AdminLogFileHelper::log_info('delete-menu-panel', "Successfully Deleted.", ['Menu Name ' . $data->menu_name]);
                Session::flash('message', "Successfully Deleted.");

            } catch (\Exception $e) {
                DB::rollback();
                AdminLogFileHelper::log_error('delete-menu-panel', $e->getMessage(), ['Menu Name ' . $data->menu_name]);
                Session::flash('danger', $e->getMessage());

            }
        }

        return redirect()->back();
    }




}