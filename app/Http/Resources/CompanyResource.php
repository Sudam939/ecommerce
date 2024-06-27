<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CompanyResource extends JsonResource
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
            "address" => $this->address,
            "contact" => $this->contact,
            "email" => $this->email,
            "logo" => asset(Storage::url($this->logo)),
        ];

        // id": 1,
        // "name": "Hamro Bazar",
        // "address": "Dharan",
        // "contact": "025-525163",
        // "email": "info@hamrobazar.com",
        // "logo": "01HN72W822HKA98YGDWMJKHZA0.png",
    }
}
