<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TradeShowRequest extends FormRequest
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

        if(empty($title))
        {
            return [
                'title'         => 'required'.$title,
                'image'         => 'image|mimes:jpeg,png,jpg,gif|max:5000'.$title,
            ];
        }else{
            return [
                //
            ];
        }




    }
}
