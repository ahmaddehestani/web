<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mobile'=> ['required','regex:/^9(1[0-9]|9[0-2]|2[0-2]|0[1-5]|41|3[0,3,5-9])\d{7}$/'],
            'mobile_prefix'=>'required'
        ];
    }
}
