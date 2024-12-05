<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'line1' => $this->line1,
            'line2' => $this->line2,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}