<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        
        return [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price,
            "discount" => $this->discount == 1 ? true : false,
            "sellingPrice" => $this->selling_price,
            "totalSaving" => $this->price - $this->selling_price,
            "description" => $this->description ?? 'N/A',
            "image" => asset(Storage::url($this->image)),

        ];
    }
}
