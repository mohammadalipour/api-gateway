<?php

namespace App\Http\Controllers\HealthCheck;

interface HttpHealthCheckInterface
{
    const DISCONNECTED = 'disconnected';
    const CONNECTED = 'connected';
    public function check(): string;
    public function getServiceName(): string;
}
