<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\CoreValueController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ExperiencePageController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ResortController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\WelcomeSectionController;
use App\Http\Controllers\Admin\VideoSectionController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\OfferIntroController;
use App\Http\Controllers\Admin\PhilosophyController;

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
    Route::prefix('galleries/{type}')
    ->where(['type' => '1|2|3'])
    ->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('galleries.index');
        Route::get('/create', [GalleryController::class, 'create'])->name('galleries.create');
        Route::post('/', [GalleryController::class, 'store'])->name('galleries.store');
        Route::get('/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
        Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
        Route::put('/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
        Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    });
    Route::prefix('offers/{type}')
    ->where(['type' => '1|2'])
    ->group(function () {
        Route::get('/', [OfferController::class, 'index'])->name('offers.index');
        Route::get('/create', [OfferController::class, 'create'])->name('offers.create');
        Route::post('/', [OfferController::class, 'store'])->name('offers.store');
        Route::get('/{offer}', [OfferController::class, 'show'])->name('offers.show');
        Route::get('/{offer}/edit', [OfferController::class, 'edit'])->name('offers.edit');
        Route::put('/{offer}', [OfferController::class, 'update'])->name('offers.update');
        Route::delete('/{offer}', [OfferController::class, 'destroy'])->name('offers.destroy');
    });
    Route::get('offer-intro', [OfferIntroController::class, 'edit'])
        ->name('offer-intro.edit');
    Route::put('offer-intro', [OfferIntroController::class, 'update'])
        ->name('offer-intro.update');
    Route::get('welcome-section', [OfferIntroController::class, 'edit'])
        ->name('welcome-section.edit');
    Route::put('welcome-section', [WelcomeSectionController::class, 'update'])
        ->name('welcome-section.update');
    Route::get('video-section', [VideoSectionController::class, 'edit'])
        ->name('video-section.edit');
    Route::put('video-section', [VideoSectionController::class, 'update'])
        ->name('video-section.update');
    Route::prefix('banners/{type}')
    ->where(['type' => '1|2|3'])
    ->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('banners.index');
        Route::get('/create', [BannerController::class, 'create'])->name('banners.create');
        Route::post('/', [BannerController::class, 'store'])->name('banners.store');
        Route::get('/{banner}', [BannerController::class, 'show'])->name('banners.show');
        Route::get('/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
        Route::put('/{banner}', [BannerController::class, 'update'])->name('banners.update');
        Route::delete('/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');
    });


    /*
        |--------------------------------------------------------------------------
        | About Singleton
        |--------------------------------------------------------------------------
        */

    Route::get(
        'about',
        [AboutController::class, 'edit']
    )->name('about.edit');


    Route::put(
        'about',
        [AboutController::class, 'update']
    )->name('about.update');
    /*
        |--------------------------------------------------------------------------
        | Philosophy CRUD
        |--------------------------------------------------------------------------
        */

    Route::resource(
        'philosophies',
        PhilosophyController::class
    );

    /*
        |--------------------------------------------------------------------------
        | Core Values CRUD
        |--------------------------------------------------------------------------
        */

    Route::resource(
        'core-values',
        CoreValueController::class
    );


    /*
|--------------------------------------------------------------------------
| Experience Page (Singleton)
|--------------------------------------------------------------------------
*/

    Route::prefix('experiences/{type}')
        ->where(['type' => '1|2'])
        ->group(function () {
            Route::get('/', [ExperiencePageController::class, 'edit'])->name('experiences.edit');
            Route::put('/', [ExperiencePageController::class, 'update'])->name('experiences.update');
        });


    /*
|--------------------------------------------------------------------------
| Experience Items
|--------------------------------------------------------------------------
*/

    Route::prefix('experience-items/{type}')
        ->where(['type' => '1|2'])
        ->group(function () {
            Route::get('/', [ExperienceController::class, 'index'])->name('experience-items.index');
            Route::get('/create', [ExperienceController::class, 'create'])->name('experience-items.create');
            Route::post('/', [ExperienceController::class, 'store'])->name('experience-items.store');
            Route::get('/{experience}/edit', [ExperienceController::class, 'edit'])->name('experience-items.edit');
            Route::put('/{experience}', [ExperienceController::class, 'update'])->name('experience-items.update');
            Route::delete('/{experience}', [ExperienceController::class, 'destroy'])->name('experience-items.destroy');
        });


    /*
|--------------------------------------------------------------------------
| Contact Page (Singleton)
|--------------------------------------------------------------------------
*/

    Route::get(
        'contact-page',
        [ContactPageController::class, 'edit']
    )->name('contact-page.edit');

    Route::put(
        'contact-page',
        [ContactPageController::class, 'update']
    )->name('contact-page.update');

    Route::resource(
        'contact-enquiry',
        ContactEnquiryController::class
    )->only(['index', 'show', 'destroy']);
});
