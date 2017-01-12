<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 11/25/16
 * Time: 4:38 PM
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;

class RoleUserRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /*'role_id'   => 'required|unique:role_user,role_id,',
            'user_id'   => 'required|unique:role_user,user_id,',*/
        ];
    }

}