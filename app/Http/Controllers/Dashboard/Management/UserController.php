<?php

namespace App\Http\Controllers\Dashboard\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Users\StoreRequest;
use App\Http\Requests\Management\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('management.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('management.users.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated             = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('users.index');
    }

    public function show($id): View
    {
        $user = User::find($id);

        return view('management.users.show', compact('user'));
    }


    public function edit($id): View
    {
        $user = User::find($id);

        return view('management.users.edit', compact('user'));
    }


    public function update(UpdateRequest $request, $id): View
    {
        $user = User::find($id);
        $user->update($request->validated());

        return view('management.users.edit', compact('user'));
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }
}
