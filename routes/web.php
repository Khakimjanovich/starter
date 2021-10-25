<?php

use App\Http\Controllers\Dashboard\Management\PermissionController;
use App\Http\Controllers\Dashboard\Management\RoleController;
use App\Http\Controllers\Dashboard\Management\UserController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware(['auth',]);
Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['auth', 'can:browse-dashboard',]
], function () {
    Route::resource('users', UserController::class)->middleware('can:browse-users');
    Route::resource('roles', RoleController::class)->middleware('can:browse-roles');
    Route::resource('permissions', PermissionController::class)->middleware('can:browse-permissions');
    Route::get('profile/me', [ProfileController::class, 'me'])->middleware('can:browse-me')->name('profile.me');
    Route::put('profile/update', [ProfileController::class, 'meUpdate'])->middleware('can:edit-me')->name('profile.update');
});
