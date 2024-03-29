<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'subject'=>$this->subject,
            'description'=>$this->description,
            'department'=>$this->department->title(),
            'closed_by'=>$this->closed_by,
            'status'=>$this->status->title(),
            'key'=>$this->key,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'priority'=>$this->priority->title(),
            'messages'=>$this->whenLoaded('messages',function (){
                return   MessageResource::collection($this->resource->messages);
            }) ,
        'user'=>$this->whenLoaded('user',function (){
                return   UserResource::make($this->resource->user);
            })
        ];
    }
}
