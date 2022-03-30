<?php

namespace App\Http\Controllers;

use App\Models\PaddlePayment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $data = [
            [
                'title' => '1$/(One time payment)',
                'type' => PaddlePayment::ONE_TIME,
                'paddle_product_id' => 26155,
            ],
            [
                'title' => '30$/(A-month subscription)',
                'type' => PaddlePayment::SUBSCRIPTION,
                'paddle_product_id' => 26206,
            ],
            [
                'title' => '150$/(Six-months subscription)',
                'type' => PaddlePayment::SUBSCRIPTION,
                'paddle_product_id' => 26245
            ],
            [
                'title' => '270$/(A-year subscription)',
                'type' => PaddlePayment::SUBSCRIPTION,
                'paddle_product_id' => 26244
            ],
        ];

        $user = $request->user();

        $plans = [];
        foreach ($data as $datum) {
            if ($datum['type'] === PaddlePayment::ONE_TIME) {
                $plans[$datum['title']] = $user->chargeProduct($datum['paddle_product_id']);
            } else {
                if (!$user->subscribedToPlan($datum['paddle_product_id'], $datum['title']))
                    $plans[$datum['title']] = $user->newSubscription($datum['title'], $datum['paddle_product_id'])
                        ->returnTo(route('dashboard'))
                        ->create();
                else
                    $plans[$datum['title']] = 'subscribed';
            }
        }

        return view('dashboard', [
            'usersQuantity' => User::all()->count(),
            'plans' => $plans,
        ]);
    }
}
