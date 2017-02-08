<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class VideoMasterRequest extends FormRequest
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
        $title = Request::input('title')?Request::input('title'):'';
        

        if($title == null)
        {
            return [
                'type' => 'required', 
                'title'=> 'required',
                'order'=> 'required|numeric|4',
                'page_type'=>' required'               
            ];
        } else{
            return [
                
            ];
        }



        
    }
}
