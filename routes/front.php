<?php

use App\Http\Controllers\Admin\NewsletterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontController;
/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
| Here is where you can register front routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'home'])->name('home');
// Route::view('about-us', 'front.about-us')->name('about-us');
// Route::view('contact', 'front.contact')->name('contact');
Route::view('experience', 'front.experience')->name('experience');
Route::view('gallery', 'front.gallery')->name('gallery');
Route::view('offers', 'front.offers')->name('offers');

Route::get('/about-us', [FrontController::class, 'aboutUs'])
    ->name('about-us');

Route::get('/experience', [FrontController::class, 'experience'])
    ->name('experience');

Route::get('/contact', [FrontController::class, 'contact'])
    ->name('contact');


Route::post('/contact/enquiry', [FrontController::class, 'store'])
    ->name('contact.enquiry.store');

Route::post('/newsletter/subscribe', [FrontController::class, 'subscribe'])
    ->name('newsletter.subscribe');


// use Illuminate\Support\Facades\Http;

// Route::get('/test-google', function () {
//     $response = Http::get('https://www.google.com');

//     return response()->json([
//         'success' => $response->successful(),
//         'status' => $response->status(),
//     ]);
// });


// View::Composer(['partials.header','partials.footer'], function($view){
//     $view->with([
//         'settings'=>Setting::get(),
//     ]);
// });
