<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\AccountUpdateRequest;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function account(Request $request): View
    {
        $user = $request->user();
        $logs = collect($user->devices()->whereDate('created_at', 'LIKE', $request->date ?? Carbon::today()->format('Y-m-d'))->get()->toArray())->map(function ($device) {
            return [
                'route' => $device['route'],
                'browser' => $device['browser'],
                'action' => $device['action'],
                'ip_address' => $device['ip_address'],
                'country_code' => $device['country_code'],
                'device' => $device['device_type'],
                'count' => $device['count'],
                'created_at' => $device['created_at'],
                'updated_at' => $device['updated_at'],
                'action_day' => Carbon::parse($device['updated_at'])->format('d M. Y'),
                'action_hour' => Carbon::parse($device['updated_at'])->format('H:i'),
                'action_type' => 'Logs'
            ];
        })->sortByDesc('action_day')->groupBy('action_day')->toArray();
        $subscriptions = collect($user->subscriptions()->whereDate('created_at', 'LIKE', $request->date ?? Carbon::today()->format('Y-m-d'))->get()->toArray())->map(function ($subscription) {
            return [
                'name' => $subscription['name'],
                'status' => $subscription['paddle_status'],
                'trial_ends_at' => $subscription['trial_ends_at'],
                'paused_from' => $subscription['paused_from'],
                'ends_at' => $subscription['ends_at'],
                'action_day' => Carbon::parse($subscription['updated_at'])->format('d M. Y'),
                'action_hour' => Carbon::parse($subscription['updated_at'])->format('H:i'),
                'action_type' => 'Subscription',
            ];
        })->sortByDesc('action_day')->groupBy('action_day')->toArray();

        $merged = array_merge_recursive($logs, $subscriptions);

        return view('profile.account', [
            'timeline' => $merged
        ]);
    }

    public function accountUpdate(AccountUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validated();

        if ($request->password) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        $this->success('Updated Successfully!');

        return redirect()->back();
    }
}
