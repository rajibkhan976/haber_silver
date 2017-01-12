<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 11/25/16
 * Time: 4:37 PM
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SettingRequest extends FormRequest
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
        $type = Request::input('type')?Request::input('type'):'';
        $last_number = Request::input('last_number')?Request::input('last_number'):'';
        $increment = Request::input('increment')?Request::input('increment'):'';
        

        if($type == null)
        {
            return [
                'type'   => 'required|unique:settings,type,' . $type,
                'last_number'    => 'required:settings,last_number,' . $last_number,
                'increment'   => 'required:settings,increment,' . $increment,
            ];
        }else{
            return [
                //
            ];
        }


    }

}