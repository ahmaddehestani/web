<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'=>$this->uuid,
            'started_at'=>$this->started_at,
            'expired_at'=>$this->expired_at,
            'status'=>$this->status,
            'user'=>$this->whenLoaded('user',function (){
                return UserResource::make($this->resource->user);
            }),
            'cycle'=>$this->whenLoaded('cycle',function () {
                return CycleResource::make($this->resource->cycle);
            }),
        ];
    }
}
