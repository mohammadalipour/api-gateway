<?php

namespace App\Http\Controllers\HealthCheck;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

class InventoryServiceHealthCheck implements HttpHealthCheckInterface
{
    private string $serviceName = 'Inventory Service';
    public function check(): string
    {
        try {
            $productServiceUrl = env('INVENTORY_SERVICE_URL');
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
