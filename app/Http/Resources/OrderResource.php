<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\OrderType;
use App\Http\Resources\OrderItemResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'order_type' => $this->order_type,
            'status' => $this->status,
            'pickup_delivery_time' => $this->pickup_delivery_time,
            'subtotal' => [
                'amount' => $this->subtotal,
                'formatted' => "£{$this->subtotal}"
            ],
            'delivery_fee' => $this->when($this->order_type === OrderType::DELIVERY->value, [
                'amount' => $this->delivery_fee,
                'formatted' => "£{$this->delivery_fee}"
            ]),
            'total' => [
                'amount' => $this->total,
                'formatted' => "£{$this->total}"
            ],
            'items' => OrderItemResource::collection($this->items),
            'address' => $this->when($this->address_id, new AddressResource($this->address)),
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'notes' => $this->notes,
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}