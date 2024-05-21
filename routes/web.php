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
Route::get('/f-login', [App\Http\Controllers\Frontend\LoginController::class, 'login']);
Route::get('/register', [App\Http\Controllers\Frontend\RegisterController::class, 'form'])->name('register');
Route::post('/register', [App\Http\Controllers\Frontend\RegisterController::class, 'register']);
Route::get('/stat', [App\Http\Controllers\Frontend\StatController::class, 'index']);
Route::get('/faq', [App\Http\Controllers\Frontend\FaqController::class, 'index']);
Route::get('/contact', [App\Http\Controllers\Frontend\ContactController::class, 'index']);
Route::post('/contact/save', [App\Http\Controllers\Frontend\ContactController::class, 'save'])->name('contact.save');
Route::get('/website-policy', [App\Http\Controllers\Frontend\WebsitePolicyController::class, 'index']);
Route::get('/privacy-policy', [App\Http\Controllers\Frontend\PrivacyPolicyController::class, 'index']);

/** Admin */
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/user', App\Http\Controllers\Admin\UserController::class)->names('admin.user');
    Route::resource('/hilight', App\Http\Controllers\Admin\HilightController::class)->names('admin.hilight');
    Route::resource('/contact', App\Http\Controllers\Admin\ContactController::class)->names('admin.contact');
    Route::resource('/website-policy', App\Http\Controllers\Admin\WebsitePolicyController::class)->names('admin.website-policy');
    Route::resource('/privacy-policy', App\Http\Controllers\Admin\PrivacyPolicyController::class)->names('admin.privacy-policy');
    Route::resource('/faq', App\Http\Controllers\Admin\FaqController::class)->names('admin.faq');
    Route::resource('/inbox', App\Http\Controllers\Admin\InboxController::class)->names('admin.inbox');
});

/** Ajax */
Route::get('/get-districts/{province}', [App\Http\Controllers\AjaxController::class, 'getDistricts']);
Route::get('/get-subdistricts/{district}', [App\Http\Controllers\AjaxController::class, 'getSubdistricts']);
Route::get('/ajaxGetZipCode', [App\Http\Controllers\AjaxController::class, 'ajaxGetZipCode'])->name('ajaxGetZipCode');

/** Social Login */
Route::get('/login/{provider}', [App\Http\Controllers\SocialiteController::class, 'redirect']);
Route::get('/login/{provider}/callback', [App\Http\Controllers\SocialiteController::class, 'callback']);

/** Test */
Route::get('/test/login', [App\Http\Controllers\Frontend\TestController::class, 'login']);
Route::get('/test/logout', [App\Http\Controllers\Frontend\TestController::class, 'logout']);
