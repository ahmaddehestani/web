<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'ticket_key'=>$this->ticket->key,
            'user'=>$this->whenLoaded('user',function (){
               return UserResource::make($this->resource->user);
            }),
            'message'=>$this->message,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
