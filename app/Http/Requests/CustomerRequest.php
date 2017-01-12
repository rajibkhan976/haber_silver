<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'first_name'    => 'required|min:3',
            'address_one'   => 'required|max:150',
            'city'          => 'required',
            'state'         => 'required',
            'zip'           => 'required',
            'country'       => 'required',
            'phone_number'  => 'numeric',
            'email_one'     => 'required',
            'status'        => 'required',
        ];
    }
}
