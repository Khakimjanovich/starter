<?php

namespace App\Listeners\Paddle;

use Laravel\Paddle\Events\WebhookReceived;

class PaddleEventListener
{
    public function handle(WebhookReceived $event)
    {
        if ($event->payload['alert_name'] === 'payment_succeeded') {

        }
    }
}
