<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'uuid'=>$this->uuid,
            'mobile_prefix'=>$this->mobile_prefix,
            'mobile'=>$this->mobile,
            'email_verified_at'=>$this->email_verified_at,
            'mobile_verified_at'=>$this->mobile_verified_at,
        ];
    }
}
