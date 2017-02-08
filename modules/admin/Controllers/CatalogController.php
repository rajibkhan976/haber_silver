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
use App\Http\Helpers\DirectoryCheckPermission;
use Modules\Admin\Models\Catalog;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Helpers\UserLogFileHelper;
use Image;
use File;

class CatalogController extends Controller
{


    protected $catalog_file_path;
    protected $catalog_image_path;
    protected $catalog_thumb_path;
    protected $catalog_file_relative_path;
    protected $catalog_image_relative_path;
    protected $catalog_thumb_relative_path;

    public function __construct()
    {
        $this->catalog_file_path = public_path('uploads/catalog/file');
        $this->catalog_image_path = public_path('uploads/catalog/image');
        $this->catalog_thumb_path = public_path('uploads/catalog/thumb');
        $this->catalog_file_relative_path = '/uploads/catalog/file';
        $this->catalog_image_relative_path = '/uploads/catalog/image';
        $this->catalog_thumb_relative_path = '/uploads/catalog/thumb';
    }


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
       
        $catalog_title = Input::get('title');
        $pageTitle = "List of Catalog Information";
        $data = Catalog::where('title', 'LIKE', '%'.$catalog_title.'%')->paginate(30);


        // drop-down - lists
        $catalog_lists = DB::table('catalog')->where('catalog.slug', '!=', 'superadmin')
                ->select('id', 'slug')->get();

        //set data
        $action_name = 'Catalog Index Page ';
        $action_url = 'admin/catalog';
        $action_detail = @\Auth::user()->username.' '. 'view Catalog :: Index ';
        $action_table = 'catalog';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::catalog.index',[
            'data'=>$data,
            'pageTitle'=>$pageTitle,
            'catalog_lists'=>$catalog_lists,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_catalog()
    {

        $pageTitle = 'Catalog Information';
        $model = new Catalog();

        if($this->isGetRequest())
        {
            $title = Input::get('title');
            $model = $model->where('title', 'LIKE', '%'.$title.'%');
            $model = $model->orWhere('status', 'LIKE', '%'.$title.'%');
            $data = $model->paginate(30);

        }else{
            $data = Catalog::where('status', '!=', 'cancel')->paginate(30);
        }
           
        //set user activity data
        $action_name = 'search role';
        $action_url = 'user/search-catalog';
        $action_detail = @\Auth::user()->username.' '. 'search catalog by :: '.Input::get('title');
        $action_table = 'catalog';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::catalog.index',[
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
    public function store_catalog(Requests\CatalogRequest $request)
    {

        $input = $request->all();

        $catalog_title = strtolower($input['title']);
        $input['slug'] = str_slug(strtolower($input['title']));
        $data = Catalog::where('title',$input['title'])->exists();

        if( !$data )
        {

            $catalog_image = $request->file('image');
            $catalog_file = $request->file('file');

            if ($catalog_image != null AND $catalog_file != null ) {
                $catalog_image_title = str_replace(' ', '-', $catalog_title . '.' . $catalog_image->getClientOriginalExtension());
                $catalog_file_title = str_replace(' ', '-', $catalog_title . '.' . $catalog_file->getClientOriginalExtension());
                $file   = $this->catalog_file_relative_path.'/'.$catalog_file_title;
                $image   = $this->catalog_image_relative_path.'/'.$catalog_image_title;
                $thumb   = $this->catalog_thumb_relative_path.'/'.$catalog_image_title;
            }elseif ($catalog_image != null AND $catalog_file == null){
                $catalog_image_title = str_replace(' ', '-', $catalog_title . '.' . $catalog_image->getClientOriginalExtension());
                $file    = '';
                $image   = $this->catalog_image_relative_path.'/'.$catalog_image_title;
                $thumb   = $this->catalog_thumb_relative_path.'/'.$catalog_image_title;
            }elseif ($catalog_image == null AND $catalog_file != null){
                $catalog_file_title = str_replace(' ', '-', $catalog_title . '.' . $catalog_file->getClientOriginalExtension());
                $file   = $this->catalog_file_relative_path.'/'.$catalog_file_title;
                $image  = '';
                $thumb  = '';
            }else{
                $file   = '';
                $image  = '';
                $thumb  = '';
            }
            $input_data = [
                    'title'=> $input['title'],
                    'slug'=> strtolower($input['slug']),
                    'file'=>  $file,
                    'image'=> $image,
                    'thumb'=> $thumb,
                    'status'=> $input['status'],
                    'updated_by'=> 0,
                ];

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                if(Catalog::create($input_data))
                {
                    if($catalog_file != null){
                        DirectoryCheckPermission::is_dir_set_permission($this->catalog_file_path);
                        $catalog_file->move($this->catalog_file_path, $catalog_file_title);
                    }
                    if($catalog_image != null){
                        DirectoryCheckPermission::is_dir_set_permission($this->catalog_image_path);
                        DirectoryCheckPermission::is_dir_set_permission($this->catalog_thumb_path);
                        $catalog_thumb_img = Image::make($catalog_image->getRealPath())->resize(50, 50);
                        $catalog_thumb_img->save($this->catalog_thumb_path . '/' . $catalog_image_title, 100);
                        $catalog_image->move($this->catalog_image_path, $catalog_image_title);
                    }

                    //set user activity data
                    $action_name = 'create a catalog';
                    $action_url = 'admin/store-catalog';
                    $action_detail = @\Auth::user()->username.' '. 'create a catalog :: '.@$input['title'];
                    $action_table = 'catalog';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                AdminLogFileHelper::log_info('store-catalog', 'Successfully Added', ['Catalog Title '.$input_data['title']]);
                Session::flash('message', 'Successfully added!');
                
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('store-catalog', $e->getMessage(), ['Catalog Title '.$input_data['title']]);
                Session::flash('danger', $e->getMessage());
          
            }


        }else{
            Session::flash('info', 'This catalog already added!');

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
        $pageTitle = 'View Catalog Informations';
        $data = Catalog::where('id', $id)->first();


        //set user activity data
        $action_name = 'View Catalog';
        $action_url = 'admin/view-catalog';
        $action_detail = @\Auth::user()->username.' '. 'view catalog by :: '.@$data->title;
        $action_table = 'catalog';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::catalog.view', ['data' => $data, 'pageTitle'=> $pageTitle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Catalog Information";
        $data = Catalog::where('id', $id)->first();
        $edit_cons = 'edit';


        //set user activity data
        $action_name = 'Edit Catalog';
        $action_url = 'admin/edit-catalog';
        $action_detail = @\Auth::user()->username.' '. 'edit catalog by :: '.@$data->title;
        $action_table = 'catalog';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::catalog.update', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
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
    
    public function update(Requests\CatalogRequest $request, $id)
    {
        $input = $request->all();
         $catalog_title = strtolower($input['title']);
         $input['slug'] = str_slug(strtolower($input['title']));
         $catalog_model = Catalog::where('id', $id)->first();
         
         $catalog_file = $request->file('file');
         $catalog_image = $request->file('image');
         
         if(isset($catalog_model) && count($catalog_model) == 1){
             if($catalog_file != null && $catalog_image != null){

                 $catalog_file_title = str_replace(' ', '-', $catalog_title . '.' . $catalog_file->getClientOriginalExtension());
                 $catalog_image_title = str_replace(' ', '-', $catalog_title . '.' . $catalog_image->getClientOriginalExtension());
                 
                 $catalog_file_name = $this->catalog_file_relative_path.'/'.$catalog_file_title;
                 $catalog_image_name = $this->catalog_image_relative_path.'/'.$catalog_image_title;
                 $catalog_thumb_name = $this->catalog_thumb_relative_path.'/'.$catalog_image_title;
                 
                 $input['file'] = $catalog_file_name;
                 $input['image'] = $catalog_image_name;
                 $input['thumb'] = $catalog_thumb_name;
             }elseif($catalog_file == null && $catalog_image != null){

                 $catalog_image_title = str_replace(' ', '-', $catalog_title . '.' . $catalog_image->getClientOriginalExtension());
                 $catalog_image_name = $this->catalog_image_relative_path.'/'.$catalog_image_title;
                 $catalog_thumb_name = $this->catalog_thumb_relative_path.'/'.$catalog_image_title;

                 unset($input['file']);
                 $input['image'] = $catalog_image_name;
                 $input['thumb'] = $catalog_thumb_name;

             }elseif($catalog_file != null && $catalog_image == null){
                 $catalog_file_title = str_replace(' ', '-', $catalog_title . '.' . $catalog_file->getClientOriginalExtension());


                 $catalog_file_name = $this->catalog_file_relative_path.'/'.$catalog_file_title;
                 $input['file'] = $catalog_file_name;
                 unset($input['image']);
                 unset($input['thumb']);

             }else {
                 unset($input['file']);
                 unset($input['image']);
                 unset($input['thumb']);
             }
         }

                    DB::beginTransaction();
                    try {
                        $result = $catalog_model->update($input);
                        DB::commit();
                        if($result){
                            if($catalog_file != null && $catalog_image != null){
                                File::Delete($catalog_model->file);
                                File::Delete($catalog_model->image);
                                File::Delete($catalog_model->thumb);
                                $catalog_file->move($this->catalog_file_path, $catalog_file_title);
                                $catalog_thumb_img = Image::make($catalog_image->getRealPath())->resize(50, 50);
                                $catalog_thumb_img->save($this->catalog_thumb_path . '/' . $catalog_image_title, 100);
                                $catalog_image->move($this->catalog_image_path, $catalog_image_title);
                            }elseif($catalog_file == null && $catalog_image != null){
                                File::Delete($catalog_model->image);
                                File::Delete($catalog_model->thumb);
                                $catalog_thumb_img = Image::make($catalog_image->getRealPath())->resize(50, 50);
                                $catalog_thumb_img->save($this->catalog_thumb_path . '/' . $catalog_image_title, 100);
                                $catalog_image->move($this->catalog_image_path, $catalog_image_title);
                            }elseif($catalog_file != null && $catalog_image == null){
                                File::Delete($catalog_model->file);
                                $catalog_file->move($this->catalog_file_path, $catalog_file_title);
                            }
                        }
                        AdminLogFileHelper::log_info('update-catalog', 'Successfully updated.', ['Catalog Title ' . $input['title']]);
                        Session::flash('message', 'Successfully updated!');
                    }
                    catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('update-catalog', $e->getMessage(), ['Catalog Title ' . $input['title']]);
                Session::flash('danger', $e->getMessage());
            }

        //set user activity data
        $action_name = 'Update catalog';
        $action_url = 'admin/update-catalog';
        $action_detail = @\Auth::user()->username . ' ' . 'catalog title :: ' . @$input['title'];
        $action_table = 'catalog';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
        return redirect()->back();
        //return redirect()->route('admin.catalog');


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
            $model = Catalog::where('id',$id)->first();
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
                    $action_name = 'cancel the catalog';
                    $action_url = 'admin/delete-catalog';
                    $action_detail = @\Auth::user()->username.' '. 'create a catalog :: '.$model->title;
                    $action_table = 'catalog';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

                }

                DB::commit();
                AdminLogFileHelper::log_info('delete-catalog', "Successfully Deleted.", ['Catalog Title '.$model->title]);
                Session::flash('message', "Successfully Deleted.");


            } catch(\Exception $e) {
                DB::rollback();
                AdminLogFileHelper::log_error('delete-catalog', $e->getMessage(), ['Catalog Title '.$model->title]);
                Session::flash('danger',$e->getMessage());

            }
        }

        return redirect()->back();
    }

}