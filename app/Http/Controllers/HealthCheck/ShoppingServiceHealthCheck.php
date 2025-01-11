<?php

namespace App\Http\Controllers\HealthCheck;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

class ShoppingServiceHealthCheck implements HttpHealthCheckInterface
{
    private string $serviceName = 'Shopping Service';
    public function check(): string
    {
        try {
            $productServiceUrl = env('SHOPPING_SERVICE_URL');
            $response = Http::post("$productServiceUrl/api/health-check");
            if ($response->failed()) {
                return self::DISCONNECTED;
            }
            return self::CONNECTED;
        } catch (ConnectionException|Throwable $exception) {
            return self::DISCONNECTED;
        }
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }
}
