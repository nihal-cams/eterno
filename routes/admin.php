<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ContactEnquiryController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\CoreValueController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ExperiencePageController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PhilosophyController;
use App\Http\Controllers\Admin\WebinarController;

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
    Route::resource('webinars', WebinarController::class);







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

    Route::get(
        'experiences',
        [ExperiencePageController::class, 'edit']
    )->name('experiences.edit');

    Route::put(
        'experiences',
        [ExperiencePageController::class, 'update']
    )->name('experiences.update');


    /*
|--------------------------------------------------------------------------
| Experience Items
|--------------------------------------------------------------------------
*/

    Route::resource(
        'experience-items',
        ExperienceController::class
    );
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