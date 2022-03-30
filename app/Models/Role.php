<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use HasFactory;

    const SUPER_ADMIN = 'superAdmin';
    const USER = 'user';

    const DEFAULT_ROLES = [
        'superAdmin' => self::SUPER_ADMIN,
        'user' => self::USER,
    ];
}
