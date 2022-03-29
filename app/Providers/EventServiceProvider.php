<?php

namespace App\Providers;

use App\Listeners\Paddle\PaymentSucceededFromPaddleListener;
use App\Models\Device;
use App\Observers\DeviceObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Laravel\Paddle\Events\PaymentSucceeded;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PaymentSucceeded::class => [
            PaymentSucceededFromPaddleListener::class,
        ]
    ];

    public function boot()
    {
        Device::observe(DeviceObserver::class);
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
