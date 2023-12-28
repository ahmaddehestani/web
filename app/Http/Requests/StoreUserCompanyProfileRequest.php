<?php

namespace App\Http\Requests;

use App\Enums\TableTicketFieldStatusEnum;
use App\Enums\TableUserCompanyProfileFieldPersonnelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserCompanyProfileRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'company_name' => ['string', 'max:255'],
            'company_personnel_count' => 'string|' . Rule::in(TableUserCompanyProfileFieldPersonnelEnum::values()),
            'company_address' => [ 'string'],
            'city' => ['string', 'max:255'],
            'province' => ['string', 'max:255'],
            'activity_field' => ['string', 'max:255'],
        ];
    }
}
