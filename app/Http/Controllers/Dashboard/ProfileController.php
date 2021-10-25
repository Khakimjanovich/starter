<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function me(): View
    {
        return view('profile.me');
    }

    public function meUpdate(UpdateRequest $request): RedirectResponse
    {
        $user      = Auth::user();
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
