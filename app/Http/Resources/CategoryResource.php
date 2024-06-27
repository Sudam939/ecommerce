<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        // "id": 2,
        // "name": "Egg",
        // "slug": "egg",
        // "image": "01HN73BZJBJYC35X9Y9NVN2T45.jpg",
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "image" => asset(Storage::url($this->image)),
            "products" => ProductResource::collection($this->products)
        ];
    }
}
