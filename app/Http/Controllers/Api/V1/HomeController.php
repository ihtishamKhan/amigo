<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\MealDealListResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\MealDeal;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductAddonCategoryVariant;
use Illuminate\Support\Facades\Cache;
use App\Models\OptionPrice;

class HomeController extends Controller
{
    private function getCacheKey($categoryId, $page): string
    {
        return "home_data_{$categoryId}_page_{$page}";
    }

    private function clearRelatedCaches($categoryId = null): void
    {
        // Clear first page cache
        Cache::forget($this->getCacheKey($categoryId, 1));

        // Clear potential paginated caches (up to a reasonable number)
        for ($page = 2; $page <= 10; $page++) {
            Cache::forget($this->getCacheKey($categoryId, $page));
        }

        // If clearing category-specific cache, also clear the all-products cache
        if ($categoryId) {
            $this->clearRelatedCaches(null);
        }
    }

    # Initial load (All products)
    // GET /api/v1/home

    # Load specific category
    // GET /api/v1/home?category_id=1

    # Load next page
    // GET /api/v1/home?page=2

    # Load next page for specific category
    // GET /api/v1/home?category_id=1&page=2

    public function index(Request $request)
    {
        if(env('APP_ENV') === 'local') {
            $this->clearRelatedCaches();
            $this->clearRelatedCaches($request->query('category_id'));
        }

        $categoryId = $request->query('category_id');
        $page = $request->query('page', 1);
        
        $cacheKey = "home_data_{$categoryId}_page_{$page}";
        $cacheDuration = now()->addDays(7);

        return Cache::remember($cacheKey, $cacheDuration, function () use ($categoryId, $page) {
            // These don't need pagination
            $mealDeals = MealDealListResource::collection(
                MealDeal::active()
                    ->with(['sections', 'sections.items'])
                    ->take(10)
                    ->get()
            );

            $categories = Category::active()
                ->orderBy('display_order')
                ->get();

            // Products with pagination and all related data
            $products = Product::with([
                'variations.optionGroups.options',
                'variations.addonCategories.addons',
                'optionGroups.options',
                'addonCategories.addons'
            ])
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->paginate(10);

            return response()->json([
                'meal_deals' => $mealDeals,
                'categories' => CategoryResource::collection($categories),
                'products' => ProductResource::collection($products),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'last_page' => $products->lastPage(),
                    'has_more' => $products->hasMorePages()
                ]
            ]);
        });
    }

    public function refreshCache(Request $request)
    {
        $categoryId = $request->query('category_id');
        $this->clearRelatedCaches($categoryId);
        
        return response()->json(['message' => 'Cache cleared successfully']);
    }
}
