<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function calcShipping()
    {
        return response()->json([
            'data' => 'Frete Calculado...',
        ]);
    }
}
