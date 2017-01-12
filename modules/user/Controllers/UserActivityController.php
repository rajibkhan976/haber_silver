<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 11/25/16
 * Time: 2:12 PM
 */

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Input;
use Illuminate\Support\Facades\DB;
use Modules\User\Models\UserActivity;

class UserActivityController
{

    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login_history()
    {
        $pageTitle = 'User Activity';

        $model = new UserActivity();
        $data = $model->with('relUsers')->orderBy('id', 'DESC')->paginate(30);


        return view('user::user_activities.index', [
            'data' => $data,
            'pageTitle'=>$pageTitle
        ]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_user_history()
    {
        $pageTitle = 'User Activity ';
        $model = new UserActivity();


        if ($this->isGetRequest())
        {
            $title = Input::get('title');

            $model = $model->with('relUsers');

            $model->where('action_name', 'LIKE', '%'.$title.'%');
            $model->orWhere('action_url', 'LIKE', '%'.$title.'%');
            $model->orWhere('action_detail', 'LIKE', '%'.$title.'%');
            $model->orWhere('action_table', 'LIKE', '%'.$title.'%');
            $model->orWhere('created_at', 'LIKE', '%'.$title.'%');

            $data = $model->paginate(30);


        } else {
            $data = $model->with('relUser')->orderBy('id', 'DESC')->paginate(30);
        }


        return view('user::user_activities.index',
        [
            'data' => $data,
            'pageTitle' => $pageTitle,

        ]);
    }

}