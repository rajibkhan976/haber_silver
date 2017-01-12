<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ImageSliderRequest extends FormRequest
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
        $id = Request::input('id') ? Request::input('id') : '';

        if (empty($id)) {
            return [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000' . $id,
                'title' => 'required|unique:image_slider,title' . $id,
                'short_description' => 'required' . $id,
            ];
        } else {
            return [
                //
            ];
        }


    }
}
