<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{

    public function index($id)
    {
        $productServiceUrl = env('PRODUCT_SERVICE_URL');
        $response = Http::get("$productServiceUrl/api/v1/products/$id");

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
    public function list(Request $request)
    {
        $productServiceUrl = env('PRODUCT_SERVICE_URL');
        $response = Http::get("$productServiceUrl/api/v1/products",$request->all());

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Product service error'], 500);
        }
    }
}
