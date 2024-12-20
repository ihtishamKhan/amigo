<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request, OrderService $orderService)
    {
        $order = $orderService->createOrder($request->validated());
        
        return new OrderResource($order);
    }

    public function getUsersOrders(Request $request)
    {
        $user = $request->user();
        $orders = $user->orders()->with('items')->latest()->get();

        return response()->json([
            'data' => $orders
        ]);
    }
}
