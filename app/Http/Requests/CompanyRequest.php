<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CompanyRequest extends FormRequest
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
         $name = Request::input('name')?Request::input('name'):'';
        

        if($name == null)
        {
            return [
                'name' => 'required|max:64',
                'description'=>'required',
                // 'name'   => 'required|unique:compny,name,' . $name,
            ];
        }else{
            return [
                //
            ];
        }



        
    }
}
