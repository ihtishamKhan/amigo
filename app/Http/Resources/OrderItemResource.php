<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->orderable->name,
            'quantity' => $this->quantity,
            'price' => [
                'amount' => $this->unit_price,
                'formatted' => "£{$this->unit_price}"
            ],
            'total' => [
                'amount' => $this->subtotal,
                'formatted' => "£{$this->subtotal}"
            ],
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}