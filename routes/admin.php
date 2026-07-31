<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ResortController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\WelcomeSectionController;
use App\Http\Controllers\Admin\VideoSectionController;
use App\Http\Controllers\Admin\BannerController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


// Auth::routes([
//     'register' => false,
//     'reset' => false,
//     'verify' => false,
// ]);
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('resorts', ResortController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('gallery-categories', GalleryCategoryController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('offers', OfferController::class);
    Route::get('welcome-section', [WelcomeSectionController::class, 'edit'])
            ->name('welcome-section.edit');
    Route::put('welcome-section', [WelcomeSectionController::class, 'update'])
        ->name('welcome-section.update');
    Route::get('video-section', [VideoSectionController::class, 'edit'])
            ->name('video-section.edit');
    Route::put('video-section', [VideoSectionController::class, 'update'])
        ->name('video-section.update');
    Route::resource('banners', BannerController::class);
});