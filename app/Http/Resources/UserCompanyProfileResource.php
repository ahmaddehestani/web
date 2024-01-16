<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCompanyProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'activity_field'          => $this->activity_field,
            'company_name'            => $this->company_name,
            'company_personnel_count' => $this->company_personnel_count?$this->company_personnel_count->title():null,
            'company_address'         => $this->company_address,
            'city'                    => $this->city,
            'province'                => $this->province,
        ];
    }
}
