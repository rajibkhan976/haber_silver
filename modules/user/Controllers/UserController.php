<?php

/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 11/2/16
 * Time: 1:29 PM
 */

namespace Modules\User\Controllers;


use App\Helpers\LogFileHelper;
use Intervention\Image\Facades\Image;
use Modules\User\Models\UserActivity;
use Mockery\CountValidator\Exception;
use Validator;
use Modules\User\Models\Country;
use App\Helpers\ImageResize;
use Modules\User\Models\Role;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Helpers\ActivityLogs;
use App\Helpers\UserLogFileHelper;


class UserController extends Controller
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "User List";
        $data = User::with('relRole')->where('status','!=','cancel')->orderBy('id', 'DESC')->paginate(30);
        $roles =  Role::where('title', '!=', 'super-admin')->get(['id', 'title'])->toArray();

        //set data
        $action_name = 'User Lists Index ';
        $action_url = 'user/lists';
        $action_detail = @\Auth::user()->username.' '. 'User Lists Index :: ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('user::users.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'roles'=>$roles
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_site_user()
    {
        $pageTitle = "Site User List";

        $data = DB::table('users')
            ->join('roles', 'users.roles_id', '=', 'roles.id')
            ->where('roles.slug','LIKE','user')
            ->where('roles.status','!=','cancel')
            ->select('users.*', 'roles.title as roles_title')
            ->orderBy('users.id', 'DESC')
            ->paginate(30);

        $roles =  Role::where('title', '!=', 'super-admin')->get(['id', 'title'])->toArray();


        //set data
        $action_name = 'Site User Lists Index ';
        $action_url = 'user/site-user-list';
        $action_detail = @\Auth::user()->username.' '. 'Site User Lists Index :: ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('user::users.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'roles'=>$roles
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_cms_user()
    {
        $pageTitle = "User List";

        $data = DB::table('users')
            ->join('roles', 'users.roles_id', '=', 'roles.id')
            ->where('roles.slug','LIKE','admin')
            ->where('roles.status','!=','cancel')
            ->select('users.*', 'roles.title as roles_title')
            ->orderBy('users.id', 'DESC')
            ->paginate(30);

        $roles =  Role::where('title', '!=', 'super-admin')->get(['id', 'title'])->toArray();


        //set data
        $action_name = 'CMS User Lists Index ';
        $action_url = 'user/cms-user-list';
        $action_detail = @\Auth::user()->username.' '. 'CMS User Lists Index :: ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('user::users.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'roles'=>$roles
        ]);
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_users(){ 
        $pageTitle = "Users List | Haber Silver ";

        $users = DB::table('users')->get();
        $roles = DB::table('roles')->get();
        //$role_title= Role::with('title')->where('id',$role_id)->first();

        return view('user::users.registration', [
            'pageTitle'=>$pageTitle,            
            'roles'=>$roles,
            'users'=>$users,
            
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user_info($id)
    {
        $pageTitle = "User Information | Haber Silver ";
        $data = DB::table('users')->where('id', $id)->first();


        //set data
        $action_name = 'View User information ';
        $action_url = 'user/show/{id}';
        $action_detail = @\Auth::user()->username.' '. 'View User information by ID :: '.$id;
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('user::users.registration', ['data' => $data, 'pageTitle'=> $pageTitle]);
    }






    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function user_logout()
    {
        $user_activity = new UserActivity();

        /* Transaction Start Here */
        DB::beginTransaction();
        try{
            $logout_history = [
                'user_id' => @\Auth::user()->id,
                'action_name' => 'user/logout',
                'action_url' => 'user/logout',
                'action_detail' => 'user logged out',
                'action_table' => 'users_activity',
            ];
            $user_activity->create($logout_history);

            Auth::logout();
            Session::flush(); //delete the session
            DB::commit();

            Session::flash('message', 'You are Logged Out !');

        }catch(\Exception $e){
            print_r($e->getMessage());
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('error', $e->getMessage());
        }


        //set data
        $action_name = 'User Logout  ';
        $action_url = 'user/user-logout';
        $action_detail = @\Auth::user()->username.' '. 'User logged out ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return redirect()->route('login');

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reset_password_form()
    {
        $pageTitle = "Reset Password | Haber Silver ";

        //set data
        $action_name = 'Reset Password  ';
        $action_url = 'user/form-reset-password';
        $action_detail = @\Auth::user()->username.' '. 'Reset Password ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('user::reset_password.reset_form', [
            'pageTitle'=>$pageTitle
        ]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user_profile()
    {
        $pageTitle = 'My Profile | HaberSilver.com';

        $user = User::findOrFail(Auth::user()->id);


        //set data
        $action_name = 'My Profile  ';
        $action_url = 'user/profile';
        $action_detail = @\Auth::user()->username.' '. 'My Profile ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('user::users.profile', [
            'pageTitle'=>$pageTitle,
            'user'=>$user
        ]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_user()
    {
        $pageTitle = 'User Information';
        $model = new User();

        if($this->isGetRequest())
        {
            $username = Input::get('username');
            $status = Input::get('status');
            $model = $model->with('relRole')->select('users.*');
            if(isset($username) && !empty($username)){
                $model = $model->where('users.username', 'LIKE', '%'.$username.'%');
            }
            if(isset($status) && !empty($status)){
                $model = $model->where('users.status', '=', $status);
            }
            $data = $model->paginate(30);
        }else{
            $data = $model->with('relRole')->where('status','!=','cancel')->orderBy('id', 'DESC')->paginate(30);
        }

        $roles =  Role::where('title', '!=', 'super-admin')->get(['id', 'title'])->toArray();



        //set data
        $action_name = 'Search user  ';
        $action_url = 'user/profile';
        $action_detail = @\Auth::user()->username.' '. 'Search user by :: '.@Input::get('username');
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('user::users.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
            'roles'=>$roles,
        ]);
    }


    /**
     * @param Requests\UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_user(Requests\UserRequest $request)
    {
        #date_default_timezone_set("Asia/Dacca");

        if($this->isPostRequest())
        {
            $input = $request->all();

            /*
             * Input data
             */
            $input_data = [
                'username'=>$input['username'],
                'email'=>$input['email'],
                'password'=> $input['password'],
                'first_name'=>$input['first_name'],
                'last_name'=>$input['last_name'],
                #'ip_address'=> getHostByName(getHostName()),
                #'last_visit'=> date('Y-m-d h:i:s', time()),
                'roles_id'=>$input['roles_id'],
                'status'=>$input['status'],
                'remember_token' => str_random(10),
                'csrf_token'=>str_random(10),
                #'business_id'=> isset($business_id)?$business_id: null
            ];

            // Start Transaction
            DB::beginTransaction();
            try {

                // store to users table
                User::create($input_data);

                DB::commit();
                Session::flash('message', 'Successfully added!');
                UserLogFileHelper::log_info('user-add', 'Successfully added!', ['Username: '.@$input_data['username']]);

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
                UserLogFileHelper::log_error('user-add', $e->getMessage(), ['Username: '.@$input['username']]);
            }
        }



        //set data
        $action_name = 'Store a new  user  ';
        $action_url = 'user/profile';
        $action_detail = @\Auth::user()->username.' '. 'Store a new user :: '.@$input['username'];
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_user($id)
    {
        $pageTitle = 'User Information';
        $data = User::with('relRole')->where('id',$id)->first();


        //set data
        $action_name = 'show user ';
        $action_url = 'user/profile';
        $action_detail = @\Auth::user()->username.' '. 'Store a new user :: '.@$id;
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return view('user::users.view', [
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
    public function edit_user($id)
    {
        $pageTitle = 'Edit User Information';
        $data = User::findOrFail($id);
        $user_role = Role::where('id', $data->role_id)->first();

        $roles =  Role::where('title', '!=', 'super-admin')->get(['id', 'title'])->toArray();


        //set data
        $action_name = 'Edit user ';
        $action_url = 'user/edit/{id}';
        $action_detail = @\Auth::user()->username.' '. 'Edit user :: '.@$id;
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('user::users.update', [
            'pageTitle'=>$pageTitle,
            'data' => $data,
            'user_role'=>$user_role,
            'roles'=>$roles
        ]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_user(Requests\UserRequest $request, $id)
    {
        if($this->isPostRequest())
        {
            #date_default_timezone_set("Asia/Dacca");
            $input = Input::all();
            $user_model = User::findOrFail($id);

            /*
             * Input data
             */
            $input_data = [
                'username'=>$input['username'],
                'email'=>$input['email'],
                'password'=> $input['password'],
                'first_name'=>$input['first_name'],
                'last_name'=>$input['last_name'],
                'roles_id'=>$input['roles_id'],
                'status'=>$input['status'],
                'remember_token' => str_random(10),
                'csrf_token'=>str_random(10),
            ];

            DB::beginTransaction();
            try{
                //store to users table
                $user_model->update($input_data);

                DB::commit();
                Session::flash('message', "Successfully Updated");
                UserLogFileHelper::log_info('update-user', 'Successfully Updated!', ['Username:'.@$input['username']]);
            }catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('error', $e->getMessage());
                UserLogFileHelper::log_error('update-user', 'error!'.$e->getMessage(), ['Username:'.@$input['username']]);
            }
        }


        //set data
        $action_name = 'Store User Data ';
        $action_url = 'user';
        $action_detail = @\Auth::user()->username.' '. 'Store User Data :: ';
        $action_table = 'users';
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
    public function destroy_user($id)
    {
        $model = User::where('id',$id)->first();

        DB::beginTransaction();
        try {
            if($model->status =='active')
            {
                $model->status = 'cancel';
                $model->last_visit = Null;
            }
            $model->save();
            DB::commit();
            Session::flash('message', "Successfully Deleted.");
            UserLogFileHelper::log_info('destroy-user', 'Successfully Deleted!change status to cancel',['User id:'.@$model->id]);
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
            UserLogFileHelper::log_error('user-destroy', $e->getMessage(), ['User id:'.@$model->id]);
        }


        //set data
        $action_name = 'Destroy User Data ';
        $action_url = 'user/destroy/{id}';
        $action_detail = @\Auth::user()->username.' '. 'Destroy User Data :: ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return redirect()->route('user.lists');
    }







    /**
     * Manage Post Request
     *
     * @return void
     */
    public function post_profile_image(Request $request)
    {
        $user_id = \Auth::user()->id;
        $user_model = User::findOrFail($user_id);

        DB::beginTransaction();
        try{
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            ]);

            //local path to move image and thumb
            $path_image = 'uploads/users/';
            $path_thumb = 'uploads/users/thumb/';

            //image file
            $image = $request->file('image');
            #$imageName = time().'.'.$request->image->getClientOriginalExtension();
            $imageName = time()."-".$request->image->getClientOriginalName();

            //thumb image resize
            $img = Image::make($image->getRealPath());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($path_thumb).$imageName);;

            // original Image
            $request->image->move(public_path($path_image), $imageName);

            //data(s) and store into db
            $user_model->image = $path_image.$imageName;;
            $user_model->thumb = $path_thumb.$imageName;;
            $user_model->save();

            //commit to store in db
            DB::commit();
            Session::flash('message', "You have successfully upload image : ".$imageName );

        }catch (\Exception $e){
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }


        //set data
        $action_name = 'post profile image';
        $action_url = 'user/profile/image';
        $action_detail = @\Auth::user()->username.' '. 'post profile image :: ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);


        return back();

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit_profile_per_user(){
        $pageTitle = 'Edit User Information';
        $data = User::findOrFail(Auth::user()->id);


        //set data
        $action_name = 'edit profile for a user';
        $action_url = 'user/profile/edit';
        $action_detail = @\Auth::user()->username.' '. 'edit profile for a user :: ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return view('user::users.update_profile_user', [
            'pageTitle'=>$pageTitle,
            'data' => $data,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_profile_per_user(Requests\UserRequest $request)
    {
        if($this->isPostRequest())
        {
            #date_default_timezone_set("Asia/Dacca");
            $input = Input::all();
            $user_model = User::findOrFail(Auth::user()->id);

            /*
             * Input data
             */
            $input_data = [
                'username'=>$input['username'],
                'email'=>$input['email'],
                'password'=> $input['password'],
                'first_name'=>$input['first_name'],
                'last_name'=>$input['last_name'],
                #'business_id'=> isset($business_id)?$business_id: null
            ];

            DB::beginTransaction();
            try{
                //store to users table
                $user_model->update($input_data);

                DB::commit();
                Session::flash('message', "Successfully Updated Your Profile data ");
                UserLogFileHelper::log_info('update-user', 'Successfully Updated!', ['Username:'.@$input['username']]);
            }catch ( Exception $e ){
                //If there are any exceptions, rollback the transaction
                DB::rollback();
                Session::flash('error', $e->getMessage());
                UserLogFileHelper::log_error('update-user', 'error!'.$e->getMessage(), ['Username:'.@$input['username']]);
            }

        }

        //set data
        $action_name = 'update profile for a user';
        $action_url = 'user/profile/update';
        $action_detail = @\Auth::user()->username.' '. 'update profile for a user :: ';
        $action_table = 'users';
        //store into user_activity table
        $user_act = ActivityLogs::set_users_activity($action_name, $action_url, $action_detail, $action_table);

        return back();
    }








}