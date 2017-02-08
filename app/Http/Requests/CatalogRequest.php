<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CatalogRequest extends FormRequest
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
        $file = Request::input('file')?Request::input('file'):'';
        $image = Request::input('image')?Request::input('image'):'';
        

        if($title == null)
        {
            return [
                'title'   => 'required|unique:roles,title,' . $title,
                'file'    => 'file|mimes:pdf|max:20480'.$file,
                'image'   => 'image|mimes:jpeg,png,jpg,gif|max:1024'.$image,
            ];
        }else{
            return [
                //
            ];
        }


    }
}