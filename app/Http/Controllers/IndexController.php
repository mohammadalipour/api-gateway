<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

class IndexController extends Controller
{
    const DISCONNECTED = 'discounted';
    const CONNECTED = 'connected';

    public function index()
    {
        $response = [
            'product-service' => $this->productServiceHealthCheck(),
            'user-service' => $this->userServiceHealthCheck(),
        ];

        return response()->json($response, 200);
    }

    private function productServiceHealthCheck(): string
    {
        try {
            $productServiceUrl = env('PRODUCT_SERVICE_URL');
            $response = Http::post("$productServiceUrl/api/health-check");
            if ($response->failed()) {
                return self::DISCONNECTED;
            }
            return self::CONNECTED;
        } catch (ConnectionException|Throwable $exception) {
            return self::DISCONNECTED;
        }
    }

    private function userServiceHealthCheck(): string
    {
        try {
            $userServiceUrl = env('USER_SERVICE_URL');
            $response = Http::post("$userServiceUrl/health-check");
            if ($response->failed()) {
                return self::DISCONNECTED;
            }
            return self::CONNECTED;
        } catch (ConnectionException|Throwable $exception) {
            return self::DISCONNECTED;
        }
    }
}
