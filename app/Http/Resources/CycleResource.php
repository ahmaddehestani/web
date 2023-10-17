<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CycleResource extends JsonResource
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
            'name'=>$this->name,
            'price'=>$this->price,
            'product'=>$this->whenLoaded('product',function (){
                return ProductResource::make($this->resource->product);
            }),
            'plan'=>$this->whenLoaded('plan',function (){
                return PlanResource::make($this->resource->plan);
            }),

        ];
    }
}
