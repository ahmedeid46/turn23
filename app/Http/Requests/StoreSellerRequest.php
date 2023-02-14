<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSellerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers|unique:sellers',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'registration_certificate'=>'file',
            'tax_card'=>'file',
            'vat_cert'=>'file',
            'invoice'=>'file',
            'delegation'=>'file',
            'phone'=>'required',
            'reference_list'=>'file',
            'cat' =>'required',
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'cat' =>' Category',
        ];
    }
}
