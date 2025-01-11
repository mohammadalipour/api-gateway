<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HealthCheck\HttpHealthCheckInterface;
use App\Http\Controllers\HealthCheck\InventoryServiceHealthCheck;
use App\Http\Controllers\HealthCheck\OrderServiceHealthCheck;
use App\Http\Controllers\HealthCheck\PaymentServiceHealthCheck;
use App\Http\Controllers\HealthCheck\ProductServiceHealthCheck;
use App\Http\Controllers\HealthCheck\ShoppingServiceHealthCheck;
use App\Http\Controllers\HealthCheck\UserServiceHealthCheck;

class HealthCheckController extends Controller
{

    public function index()
    {
        $services = [
            ProductServiceHealthCheck::class,
            UserServiceHealthCheck::class,
            OrderServiceHealthCheck::class,
            PaymentServiceHealthCheck::class,
            ShoppingServiceHealthCheck::class,
            InventoryServiceHealthCheck::class,
        ];

        $response = [];

        /** @var HttpHealthCheckInterface $service */
        foreach ($services as $service) {
            $service = new $service;
            $response[$service->getServiceName()] = $service->check();
        }

        return response()->json($response, 200);
    }
}
