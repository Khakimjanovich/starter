<?php

namespace App\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

class Login
{
    /**
     * @throws Error
     */
    public function __invoke($_, array $args)
    {
        $guard = Auth::guard(config('sanctum.guard'));

        if (!$guard->attempt($args)) {
            throw new Error('Invalid credentials.');
        }
        $user = $guard->user();
        return [
            'token' => $user->createToken('duck')->plainTextToken
        ];
    }
}
