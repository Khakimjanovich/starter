<?php

namespace App\Listeners\Paddle;

use Illuminate\Support\Facades\Log;
use Laravel\Paddle\Events\PaymentSucceeded;

class PaymentSucceededFromPaddleListener
{
    public function handle(PaymentSucceeded $event)
    {
        Log::info('PaymentSucceeded', $event->payload);
    }
}
