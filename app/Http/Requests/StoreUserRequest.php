<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mobile'=> ['required','unique:users,mobile','regex:/^9(1[0-9]|9[0-2]|2[0-2]|0[1-5]|41|3[0,3,5-9])\d{7}$/'],
            'mobile_prefix'=>'',
            'name'=>'required|string|min:2|max:80',
            'email'=>'email|unique:users,email',
            'password'=>'required|min:6|max:64',
            'confirmed_password'=>'required|same:password',
            'roles'=> 'nullable|array',
            'roles.*'=> 'exists:roles,id',
        ];
    }
}
