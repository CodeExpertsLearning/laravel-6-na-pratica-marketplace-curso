<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShippingService;

class ShippingController extends Controller
{
    public function calcShipping(ShippingService $shippingService, Request $request)
    {

        $shipping = $shippingService
                        ->setItem(\App\Product::whereSlug($request->productId)->first())
                        ->calculateShipping($request->zipcode);

        return response()->json([
            'data' => [
                'shipping' => $shipping
            ],
        ]);
    }
}
