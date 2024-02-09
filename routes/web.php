<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('wellcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => '',
    'middleware' => ['auth'],
], function () {

    Route::resource('posts', 'PostController');
});

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin',
    'middleware' => ['auth'],
], function () {
    Route::resource('users', UserController::class);
});

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => 'admin',
    'middleware' => ['auth'],
], function () {
    Route::resource('roles', 'RoleController');
    Route::get('/select-roles', [RoleController::class, 'SelectRoles'])->name('roles.selectRoles');
    Route::resource('permissions', 'PermissionController');
});
