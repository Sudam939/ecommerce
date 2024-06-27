<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CartResource extends JsonResource
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
            "product_id" => $this->product->id,
            "product" => $this->product->name,
            "qty" => $this->qty,
            "price" => $this->product->selling_price,
            "amount" => $this->total,
            "image" => asset(Storage::url($this->product->image)),
        ];
    }
}
