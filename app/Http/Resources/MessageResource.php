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
            'key'=>$this->ticket->key,
            'user'=>$this->user->mobile,
            'message'=>$this->message,
        ];
    }
}
