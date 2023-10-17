<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'url'=>$this->url,
            'title'=>$this->title,
            'description'=>$this->description,
            'category'=>$this->whenLoaded('category',function () {
                return CategoryResource::make($this->resource->category);
            }),
        ];
    }
}
