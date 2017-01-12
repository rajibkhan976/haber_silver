<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Modules\User\Models\PasswordReset;
use Illuminate\Support\Facades\Input;
use DB;
use Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset_password(Request $request)
    {

        $email = Input::get('email');

        $user_exists = DB::table('users')->where('email', '=', $email)->exists();
        if($user_exists)
        {
            $user = DB::table('users')->where('email', '=', $email)->first();

            $model = new PasswordReset();
            $model->users_id = $user->id;
            $model->email = $user->email;
            $model->token = str_random(30);
            $token = $model->token;
            $model->expire_at = date("Y-m-d h:i:s", (strtotime(date('Y-m-d h:i:s', time())) + (60 * 30)));

            if($model->save()) {

                try{
                    \Mail::send('user::reset_password.email_notification', array('link'=>$token,'user'=>$user),
                        function($message) use ($user)
                        {
                            $message->from('selim@bglobalsourcing.com', 'User Password Reset Notification');

                            $message->to($user->email);
                            $message->replyTo('selim@bglobalsourcing.com','forgot password Request');
                            $message->subject('Forgot Password Reset Mail');
                        });

                    Session::flash('message', 'Successfully sent email to reset password. Please check your email!');

                }catch (\Exception $e){
                    Session::flash('error', $e->getMessage());
                }
            }else{
                Session::flash('error', 'Does not Save!');
            }
        }else{
            Session::flash('error', 'The Specified Email address Is not Registered. Please Try Again.');
        }

        return redirect()->back();

    }


    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */

    public function update_reset_password($token)
    {

        $user = PasswordReset::where('token','=',$token)->first();

        $current_time = date('Y-m-d h:i:s', time());

        if(isset($user))
        {
            $data = [
                isset($user->id) ? 'users_id': '' => isset($user->id) ? $user->id : '',
                'expire_at' => isset($user) ? $user->expire_at : '',
            ];

            if ($data['expire_at'] > $current_time && $user['status']==1 )
            {
                $id =  isset($user->id) ? $data['users_id']:'';
                return view('user::reset_password._form_change_password',['id'=>$id]);
            }
            if($data['expire_at'] < $current_time)
            {
                Session::flash('error', 'Session Time Expired. Please Try Again.');
            }

        }else{
            Session::flash('error', 'Invalid Password Reset Link. Please Try Again.');

        }
        return redirect()->route('login');

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set_new_password(Request $request)
    {
        $data = $request->all();
        $users = DB::table('password_resets')->where('id', '=', $data['id'])->first();
        $model = User::findOrFail($users->users_id);

        if($data['confirm_password']==$data['password'])
        {
            //update status and password
            #date_default_timezone_set("Asia/Dacca");
            $user_update_data =[
                'password'=>\Hash::make($data['password']),
                'last_visit'=>date('Y-m-d h:i:s', time()),
            ];
            DB::beginTransaction();
            try {
                if ($model->update($user_update_data)) {
                    DB::table('password_resets')->where('users_id', '=', $users->users_id)->update(array('status' => 0));
                }
                DB::commit();
                Session::flash('message', 'You have reset your password successfully. You may Login now.');
                #LogFileHelper::log_info('save_new_password', 'successfully reset password',["New password for user_id".$user_id->user_id]);
                return redirect()->route('login');

            }catch(Exception $e){
                Session::flash('message', $e->getMessage());
                #LogFileHelper::log_error('save_new_password', $e->getMessage(), ["New password for user_id".$user_id->user_id]);
            }
        }else{
            Session::flash('error', "Password and Confirm Password Does not match !");
        }
        return redirect()->back();
    }



}
