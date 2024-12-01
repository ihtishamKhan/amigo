<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()
            ->when($request->category_id, function($q) use ($request) {
                return $q->where('category_id', $request->category_id);
            })
            ->when($request->search, function($q) use ($request) {
                return $q->where('name', 'like', "%{$request->search}%");
            });
            
        $products = $query->paginate(10);
        
        return ProductResource::collection($products);
    }
    
    public function featured()
    {
        $products = Product::active()
            ->featured()
            ->take(5)
            ->get();
            
        return ProductResource::collection($products);
    }
    
    public function mealDeals()
    {
        $deals = Product::active()
            ->where('is_meal_deal', true)
            ->take(5)
            ->get();
            
        return ProductResource::collection($deals);
    }
}
