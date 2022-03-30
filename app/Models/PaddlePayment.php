<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaddlePayment extends Model
{
    use HasFactory;

    const DEFAULT_TYPES = [
        'oneTime' => self::ONE_TIME,
        'subscription' => self::SUBSCRIPTION,
    ];

    const ONE_TIME = 'oneTime';
    const SUBSCRIPTION = 'subscription';
}
