<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 11/25/16
 * Time: 2:07 PM
 */

namespace Modules\Admin\Controllers;

#use App\Helpers\LogFileHelper;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Helpers\ActivityLogs;
use App\Helpers\AdminLogFileHelper;
use Modules\Admin\Models\VideoMaster;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Helpers\DirectoryCheckPermission;
use Image;
use File;
use Validator;

class VideoMasterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $image_path;
    protected $thumb_path;
    protected $video_path;
    protected $image_store_path;
    protected $thumb_store_path;
    protected $video_store_path;

    public function __construct()
    { 
        $this->image_path = public_path('uploads/video-master/images/');
        $this->thumb_path = public_path('uploads/video-master/thumbs/');
        $this->video_path = public_path('uploads/video-master/videos/');

        $this->image_store_path = '/uploads/video-master/images/';
        $this->thumb_store_path = '/uploads/video-master/thumbs/';
        $this->video_store_path = '/uploads/video-master/videos/';

            DirectoryCheckPermission::is_dir_set_permission($this->image_path);
            DirectoryCheckPermission::is_dir_set_permission($this->thumb_path);
            DirectoryCheckPermission::is_dir_set_permission($this->video_path);
    }

    public function index()
    { 
        $pageTitle = "Video Master List";       
        $title = strtolower(Input::get('title'));
        $data = VideoMaster::where('title', 'LIKE', '%'.$title.'%')->orderBy('id', 'DESC')->paginate(30);


        //set data
        $action_name = 'video master index';
        $action_url = 'admin/video-master';
        $action_detail = @\Auth::user()->username.' '. 'View all list of video master ';
        $action_table = 'video_master';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::video_master.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            
        ]);
    }   
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_video_master(Requests\VideoMasterRequest $request)
    { 
        
        $title = strtolower($request->title);        

        $rules = [
            'caption_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'video_file'  => 'required|mimes:mp4,ogg,webm'
        ];

        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }     
            
        if (Input::hasFile('caption_image')) {
        
            $image = $request->file('caption_image'); 
            $imagename = $title.'-'.time().'.'.$image->getClientOriginalExtension();

            //For Save image & thumb name into database
            $caption_original_image = $this->image_store_path.$imagename;
            $caption_original_thumb = $this->thumb_store_path.$imagename; 
           
            //For upload image & thumb 
            $thumb_img = Image::make($image->getRealPath())->resize(50, 50);
            $thumb_img->save($this->thumb_path.$imagename,100);
            $image->move($this->image_path, $imagename);
        
        } else {
            $caption_original_image = 'not_found'; 
            $caption_original_thumb = 'not_found';
        } 
        
        /*-----------------video upload------------------*/
        if (Input::hasFile('video_file')) {
            $video = $request->file('video_file');
            $videoname = $title.'-'.time().'.'.$video->getClientOriginalExtension();      
            $video_file = $this->video_store_path.$videoname;
            $video->move($this->video_path, $videoname);
        } else {
           $video_file = 'not_found'; 
        } 
        
        $input_data = [
            'type'       =>  $request->type,
            'title'      =>  $title,
            'caption'    =>  $request->caption,
            'caption_image' => $caption_original_image, 
            'caption_thumb' => $caption_original_thumb, 
            'video_file'    => $video_file,
            'order'      =>  $request->order,
            'page_type'  =>  $request->page_type,
            'status'     =>  $request->status, 
        ];

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            if(VideoMaster::create($input_data))
            {
                //set user activity data
                $action_name = 'create a video master';
                $action_url = 'admin/store-video-master';
                $action_detail = @\Auth::user()->username.' '. 'create a role :: '.@$request->titple;
                $action_table = 'video_master';
                //store into user_activity table
                $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
            }

            DB::commit();
            AdminLogFileHelper::log_info('store-video-master', 'Successfully Added', ['Video Master Title '.$request->title]);
            Session::flash('message', 'Successfully added!');
            
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            AdminLogFileHelper::log_error('store-video-master', $e->getMessage(), ['Video Master Title'.$request->title]);
            Session::flash('danger', $e->getMessage());
      
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
        $pageTitle = 'View Video Master Informations';
        $data = VideoMaster::where('id',$id)->first();


        //set user activity data
        $action_name = 'View Video Master';
        $action_url = 'user/view-video-master';
        $action_detail = @\Auth::user()->username.' '. 'view video master by :: '.@$data->title;
        $action_table = 'video_master';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::video_master.view', [
            'data' => $data, 
            'pageTitle'=> $pageTitle
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Video Master Informations";              
        $data = VideoMaster::where('id',$id)->first();
        $edit_cons = 'edit';

        //set user activity data
        $action_name = 'Edit Video Master';
        $action_url = 'admin/edit-video-master';
        $action_detail = @\Auth::user()->username.' '. 'edit video master by :: '.@$data->title;
        $action_table = 'video_master';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::video_master.update', [
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
    public function update(Requests\VideoMasterRequest $request, $id)
    { 
        
        $video_master_title = strtolower($request->title);
        $video_master_query = VideoMaster::where('id',$id)->first(); 
       
        $image = $request->file('caption_image'); 
             
        /*...................................................................*/
        if($image != null){  

            $rules = [
                'caption_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:1024'
            ];

            $validator = Validator::make(Input::all(),$rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $imagename = $request->title.'-'.time().'.'.$image->getClientOriginalExtension();

            //For Save image & thumb name into database
    /*        $caption_original_image = '/uploads/video-master/images/'.$imagename;
            $caption_original_thumb = '/uploads/video-master/thumbs/'.$imagename; */

            //For Save image & thumb name into database
            $caption_original_image = $this->image_store_path.$imagename;
            $caption_original_thumb = $this->thumb_store_path.$imagename; 
            /*---------------------------------------------------------------------*/
            /*$destinationPath1 = public_path('uploads/video-master/images/');;
            $destinationPath2 = public_path('uploads/video-master/thumbs/');       */ 
            
            File::Delete($this->image_path.$video_master_query->caption_image);
            File::Delete($this->thumb_path.$video_master_query->caption_thumb);
            
            //For upload image & thumb 
            $thumb_img = Image::make($image->getRealPath())->resize(50, 50);
            $thumb_img->save($this->thumb_path.$imagename,100);
            $image->move($this->image_path, $imagename);

        }else{
             
           $caption_original_image = $video_master_query->caption_image;
           $caption_original_thumb = $video_master_query->caption_thumb;                
        }  
        
        $video = $request->file('video_file'); 
        if($video != null){

            $rules = [               
                'video_file'  => 'required|mimes:mp4,ogg,webm'
            ];

            $validator = Validator::make(Input::all(),$rules);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }  

            $video = $request->file('video_file');
            $videoname = $video_master_title.'-'.time().'.'.$video->getClientOriginalExtension();      
            $video_file = $this->video_store_path.$videoname;
            $video->move($this->video_path, $videoname);

            File::Delete($this->video_path.$video_master_query->video_file);          
            
        } else {
            $video_file = $video_master_query->video_file;
        } 
        
        
        /*................Updated Data...........................*/
        $input_data = [
            'type'       =>  $request->type,
            'title'      =>  $video_master_title,
            'caption'    =>  $request->caption,
            'caption_image' => $caption_original_image, 
            'caption_thumb' => $caption_original_thumb, 
            'video_file'    => $video_file, 
            'order'      =>  $request->order,
            'page_type'  =>  $request->page_type,
            'status'     =>  $request->status
        ];      
       /*...................................................................*/
              

        if($video_master_title)
        {               
            /*...................................................................*/
            $model = VideoMaster::where('id',$id)->first();
            DB::beginTransaction();
            try {
                $model->update($input_data);
                DB::commit();
                AdminLogFileHelper::log_info('update-video-master', 'Successfully updated.', ['Video Master '.$request->title]);
                Session::flash('message', 'Successfully Updated!');

            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                AdminLogFileHelper::log_error('update-video-master', $e->getMessage(), ['Video Master '.$request->title]);
                Session::flash('danger', $e->getMessage());
            }
            /*...................................................................*/    
        }

        //set user activity data
        $action_name = 'Update Video Master';
        $action_url = 'admin/update-video-master';
        $action_detail = @\Auth::user()->username.' '. 'update video master by :: '.@$request->title;
        $action_table = 'video_master';
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
            $model = VideoMaster::where('id',$id)->first();
            DB::beginTransaction();
            try { 

                if ($model->status == 'active') {
                    $model->status = 'inactive';
                } else {
                    $model->status = 'active';
                }

                if ($model->save()) {
                    //set data
                    $action_name = 'cancel the video master';
                    $action_url = 'admin/delete-video-master';
                    $action_detail = @\Auth::user()->username . ' ' . 'deletes a video master, title :: ' . $model->title;
                    $action_table = 'video_master';
                    //store into user_activity table
                    $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);
                }

                DB::commit();
                AdminLogFileHelper::log_info('delete-video-master', "Successfully Deleted.", ['Video Master Title ' . $model->title]);
                Session::flash('message', "Successfully Deleted.");


            } catch(\Exception $e) {
                DB::rollback();
                AdminLogFileHelper::log_error('delete-video-master', $e->getMessage(), ['Video Master Title '.$model->title]);
                Session::flash('danger',$e->getMessage());

            }
        }

        return redirect()->back();
    }


    public function search_video_master()
    {

        $pageTitle = 'Video Master Information';
        $title = Input::get('title');      
        $data = VideoMaster::where('title', 'LIKE', '%'.$title.'%')->orWhere('type', 'LIKE', '%'.$title.'%')->paginate(30);
        
           
        //set user activity data
        $action_name = 'search video master';
        $action_url = 'user/search-video-master';
        $action_detail = @\Auth::user()->username.' '. 'search video master by :: '.Input::get('title');
        $action_table = 'video_master';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('admin::video_master.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
            ]);
    }

    public function show_video($id) 
    {
        $pageTitle = 'View Video';
        $data = VideoMaster::where('id',$id)->first();

        //set user activity data
        $action_name = 'vhow Video Master';
        $action_url = 'user/show-video-master';
        $action_detail = @\Auth::user()->username.' '. 'show video master by :: '.@$data->title;
        $action_table = 'video_master';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('admin::video_master.show-video', [
            'data' => $data, 
            'pageTitle'=> $pageTitle
            ]);
    }


}