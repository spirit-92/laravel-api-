<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class RegistrationValidate extends FormRequest
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
            'name'=>'nullable|unique:users,user_name',
            'password'=>'nullable|min:6',
            'email'=>'nullable|email|unique:users,email'
        ];
    }
}
