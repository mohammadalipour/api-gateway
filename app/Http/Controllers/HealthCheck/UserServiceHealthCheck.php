<?php

namespace App\Http\Controllers\HealthCheck;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

class UserServiceHealthCheck implements HttpHealthCheckInterface
{
    private string $serviceName = 'User Service';

    public function check(): string
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

    public function getServiceName(): string
    {
        return $this->serviceName;
    }
}
