<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'user_uuid'=>'required|uuid|exists:users,uuid',
            'cycle_uuid'=>'required|uuid|exists:cycles,uuid',
            'started_at'=>'',
            'expired_at'=>'',
            'status'=>'boolean',
        ];
    }
}
