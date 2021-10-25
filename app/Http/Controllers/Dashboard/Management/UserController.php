<?php

namespace App\Http\Controllers\Dashboard\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Users\StoreRequest;
use App\Http\Requests\Management\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

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

        session()->put([
            'message' => 'Created a new model successfully',
            'type' => 'success'
        ]);

        return redirect()->route('users.index');
    }

    public function show($id): View
    {
        $user = User::find($id);

        return view('management.users.show', compact('user'));
    }


    public function edit($id): View
    {
        $user  = User::find($id);
        $roles = Role::all();

        return view('management.users.edit', compact('user', 'roles'));
    }


    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->password) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $user = User::find($id);
        if (!$user) {
            session()->put([
                'message' => 'Cannot find a model',
                'type' => 'error',
            ]);

            return redirect()->back();
        }

        $user->syncRoles($request->roles);

        $user->update($validated);

        session()->put([
            'message' => 'Updated model successfully',
            'type' => 'success'
        ]);

        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);

        if (!$user) {
            session()->put([
                'message' => 'Cannot find a model',
                'type' => 'error',
            ]);

            return redirect()->back();
        }

        $user->delete();

        session()->put([
            'message' => 'Deleted the model successfully',
            'type' => 'success'
        ]);

        return redirect()->back();
    }
}
