<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        
        $user = $request->user();
        $addresses = $user->addresses;

        return response()->json([
            'data' => $addresses
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'address_line1' => 'required|string',
            'address_line2' => 'string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'is_default' => 'boolean'
        ]);

        $address = $user->addresses()->create($data);

        return response()->json([
            'data' => $address
        ]);
    }
}
