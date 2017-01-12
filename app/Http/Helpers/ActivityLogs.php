<?php

namespace App\Http\Helpers;

use Modules\User\Models\UserActivity;

class ActivityLogs
{

    /**
     * @param $action_name
     * @param $action_url
     * @param $action_detail
     * @param $action_table
     * @return bool
     */
    public static function set_users_activity($action_name, $action_url, $action_detail, $action_table)
    {

        $user_model = new UserActivity();
        $user_history = [
            'action_name' => $action_name,
            'action_url' => $action_url,
            'action_detail' => $action_detail,
            'action_table' => $action_table,
        ];

        $user_model->create($user_history);

        return true;

    }


}