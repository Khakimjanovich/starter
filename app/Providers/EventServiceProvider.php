<?php

namespace App\Providers;

use App\Models\Device;
use App\Observers\DeviceObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
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
