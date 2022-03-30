<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\Management\PermissionController;
use App\Http\Controllers\Management\RoleController;
use App\Http\Controllers\Management\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
Route::get('/', fn() => view('welcome'))->middleware('log')->name('welcome');

Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['auth', 'verified', 'log'],
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
});

Route::get('/migrate',fn()=>\Illuminate\Support\Facades\Artisan::call('migrate'));
