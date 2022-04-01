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
        $logs = collect($this->devices($request))->map(function ($device) {
            return [
                'route' => $device['route'],
                'count' => $device['count'],
                'action_day' => Carbon::parse($device['updated_at'])->format('d M. Y'),
                'action_hour' => Carbon::parse($device['updated_at'])->format('H:i'),
                'action_type' => 'Logs'
            ];
        })->sortByDesc('action_day')->groupBy('action_day')->toArray();

        $subscriptions = collect($this->subscriptions($request))->map(function ($subscription) {
            return [
                'name' => $subscription['name'],
                'status' => $subscription['paddle_status'],
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

    private function devices(Request $request): array
    {
        return $request->user()->devices()
            ->select('route', 'count', 'created_at', 'updated_at')
            ->whereDate('created_at', 'LIKE', $request->date ?? Carbon::today()->format('Y-m-d'))
            ->get()
            ->toArray();
    }

    private function subscriptions(Request $request): array
    {
        return $request->user()
            ->subscriptions()
            ->select('name', 'paddle_status', 'updated_at', 'created_at')
            ->whereDate('created_at', 'LIKE', $request->date ?? Carbon::today()->format('Y-m-d'))
            ->get()
            ->toArray();
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
