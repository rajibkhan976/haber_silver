<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuPanelRequest extends FormRequest
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
            'menu_type' => 'required',
            'menu_name' => 'required|min:3',
            'route' => 'required|min:3',
            'parent_menu_id'  => 'required',
            'icon_code'  => 'required',
            'menu_order'  => 'required',
        ];
    }

}
