<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\products;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    public function getProducts(): JsonResponse
    {
        $products = products::all();

        return response()->json([
            'products' => $products,
        ]);
    }
}
