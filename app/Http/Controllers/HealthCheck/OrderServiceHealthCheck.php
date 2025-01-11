<?php

namespace App\Http\Controllers\HealthCheck;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

class OrderServiceHealthCheck implements HttpHealthCheckInterface
{
    private string $serviceName = 'Order Service';
    public function check(): string
    {
        return self::DISCONNECTED;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }
}
