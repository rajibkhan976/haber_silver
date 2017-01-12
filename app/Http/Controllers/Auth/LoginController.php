<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;
use Collective\Html\FormFacade;
use Collective\Html\HtmlFacade;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\UserActivity;
use Modules\User\UserLoginHistory;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            #'name' => 'required|max:255',
            'username' => 'required',
            'password' => 'required',
        ]);
    }



    public function index()
    {

        if(Auth::check())
        {
            Session::flash('message', "You Have Already Logged In.");
            return redirect()->intended('admin/dashboard');

        }else{

            $pageTitle = "Login | Haber Silver ";

            return view('admin::login.login', [
                'pageTitle'=>$pageTitle
            ]);
        }


    }


    /*
     * Post_login
     */
    public function post_login(Request $request)
    {
        $data = Input::all();

        if(count($data)>0){
            #date_default_timezone_set("Asia/Dacca");
            if(Auth::check())
            {
                Session::flash('message', "You Have Already Logged In.");
                return redirect()->intended('admin/dashboard');
            }
            else
            {
                //check input username is email or username
                #$username_field = filter_var($data['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

                //Check username/email is exists into the database
                $user_data_exists = DB::table('users')->where('username', $data['username'])->exists();


                if($user_data_exists)
                {
                    $user_data = DB::table('users')->where('username', $data['username'])->first();
                    $check_password = Hash::check( $data['password'], $user_data->password);



                    //if password matched
                    if($check_password)
                    {
                        //if user is inactive
                        if($user_data->status=='inactive')
                        {
                            Session::flash('error', "Sorry! Your Account Is Inactive.Please Contact With Administrator To active Account.");
                        }
                        else
                        {
                            if(Auth::check())
                            {
                                Session::flash('message', "You are already Logged-in! ");

                            }else{
                                $attempt = Auth::attempt([
                                    'username' => $request->get('username'),
                                    'password' => $request->get('password'),
                                ]);

                                if($attempt)
                                {
                                    DB::beginTransaction();
                                    try{
                                        DB::table('users')->where('id', '=', $user_data->id)->update(array('last_visit' =>date('Y-m-d h:i:s', time())));
                                        $user_model = new UserActivity();
                                        $user_history = [
                                            'action_name' => 'user-login',
                                            'action_url' => 'get-user-login',
                                            'action_details' => Auth::user()->username.' '. 'logged in',
                                            'action_table' => 'users',
                                        ];
                                        $user_model->create($user_history);
                                        DB::commit();
                                    }catch ( \Exception $e ){
                                        //If there are any exceptions, rollback the transaction
                                        DB::rollback();
                                    }

                                    Session::flash('message', "Successfully  Logged In.");

                                }else{
                                    Session::flash('danger', "Password Incorrect.Please Try Again");
                                }
                            }
                            return redirect()->intended('admin/dashboard');
                        }
                    }else{
                        Session::flash('danger', "Password Incorrect.Please Try Again!!!");
                    }
                }else{
                    Session::flash('danger', "UserName/Email does not exists.Please Try Again");

                }
                return redirect()->back();
            }
        }else{
            Session::flash('danger', "UserName/Email does not exists.Please Try Again");
            return redirect()->route('login');
        }


    }




}
