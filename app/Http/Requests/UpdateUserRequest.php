<?php

namespace App\Http\Requests;

use App\Enums\TableUserCompanyProfileFieldPersonnelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'mobile'                  => ['required', 'regex:/^9(1[0-9]|9[0-2]|2[0-2]|0[1-5]|41|3[0,3,5-9])\d{7}$/', 'unique:users,mobile,' . $this->user()->id],
            'name'                    => 'required|string|min:2|max:80',
            'email'                   => 'email|unique:users,email,' . $this->user()->id,
            'company_name'            => ['string', 'max:255'],
            'company_personnel_count' => 'string|' . Rule::in(TableUserCompanyProfileFieldPersonnelEnum::values()),
            'company_address'         => ['string'],
            'city'                    => ['string', 'max:255'],
            'province'                => ['string', 'max:255'],
            'activity_field'          => ['string', 'max:255'],
        ];
    }
}
