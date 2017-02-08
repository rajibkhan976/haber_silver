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
        $id = Request::input('id')?Request::input('id'):'';
        $last_number = Request::input('last_number')?Request::input('last_number'):'';
//        $increment = Request::input('increment')?Request::input('increment'):'';
       // $code = Request::input('code')?Request::input('code'):'';


        if($last_number)
        {
            return [
               'type'   => 'required|unique:settings,type,' . $id,
                'type'   => 'required' . $id,
                'last_number'    => 'required:settings,last_number,' . $id,
                'increment'   => 'required:settings,increment,' . $id,
                'code'   =>  'required|min:4|max:4'. $id,
            ];
        }else{
            return [
                //
            ];
        }

//





    }


    /*public function rules()
    {

        return [
           'type'   => 'required',
            'last_number'    => 'required',
            'increment'   => 'required',
            'code'   =>  'required|min:4|max:4',
        ];

    }*/

}