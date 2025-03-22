<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealDealResource extends JsonResource
{
    public function toArray($request): array
    {
        // Determine if detailed information is requested
        $detailed = $request->boolean('detailed', false);
        
        if ($detailed) {
            return (new MealDealDetailResource($this))->toArray($request);
        } else {
            return (new MealDealListResource($this))->toArray($request);
        }
    }
}