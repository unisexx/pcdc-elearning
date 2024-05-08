<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('home');
});

Auth::routes();

/** Frontend */
Route::get('/home', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/login', [App\Http\Controllers\Frontend\LoginController::class, 'login']);
Route::get('/register', [App\Http\Controllers\Frontend\LoginController::class, 'register']);

/** Admin */
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/user', App\Http\Controllers\Admin\UserController::class)->names('admin.user');
    Route::resource('/hilight', App\Http\Controllers\Admin\HilightController::class)->names('admin.hilight');
    Route::resource('/contact', App\Http\Controllers\Admin\ContactController::class)->names('admin.contact');
    Route::resource('/faq', App\Http\Controllers\Admin\FaqController::class)->names('admin.faq');
    Route::resource('/inbox', App\Http\Controllers\Admin\InboxController::class)->names('admin.inbox');
});

/** Social Login */
Route::get('/login/{provider}', [App\Http\Controllers\SocialiteController::class, 'redirect']);
Route::get('/login/{provider}/callback', [App\Http\Controllers\SocialiteController::class, 'callback']);

/** Test */
Route::get('/test/login', [App\Http\Controllers\Frontend\TestController::class, 'login']);
Route::get('/test/logout', [App\Http\Controllers\Frontend\TestController::class, 'logout']);
