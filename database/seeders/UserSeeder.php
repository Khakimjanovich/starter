<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate([
            'name' => 'Super Admin',
            'email' => 'yunusalikhakimjanovich@gmail.com',
        ], [
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        $user->assignRole(Role::whereName('SuperAdmin')->first());
    }
}
