<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Paddle\Events\WebhookReceived;

class PaddleWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        Log::info('payment',$request->all());
    }
}
