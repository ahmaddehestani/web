<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaignRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'name'=>"required|string|max:255|min:3",
            'mobile'=> ['required','regex:/^09(1[0-9]|9[0-2]|2[0-2]|0[1-5]|41|3[0,3,5-9])\d{7}$/'],
            'time'=>"",
        ];
    }
}
