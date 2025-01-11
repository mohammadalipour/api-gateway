<?php

namespace App\Http\Controllers\HealthCheck;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

class PaymentServiceHealthCheck implements HttpHealthCheckInterface
{
    private string $serviceName = 'Payment Service';
    public function check(): string
    {
        return self::DISCONNECTED;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }
}
