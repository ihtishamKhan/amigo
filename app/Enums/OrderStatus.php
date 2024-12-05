<?php

namespace App\Enums;

enum OrderStatus: string
{
    case CREATED = 'created';
    case CONFIRMED = 'confirmed';
    case PREPARING = 'preparing';
    case READY = 'ready';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
}