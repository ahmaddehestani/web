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
            'id'                      => $this->id,
            'activity_field'          => $this->activity_field??null,
            'company_name'            => $this->company_name??null,
            'company_personnel_count' => $this->company_personnel_count??null,
            'company_address'         => $this->company_address??null,
            'city'                    => $this->city??null,
            'province'                => $this->province??null,
            //            'user'                    => $this->whenLoaded('user', function () {
            //                return UserResource::make($this->resource->user);
            //            }),

        ];
    }
}
