<?php

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
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'home'])->name('home');
Route::view('about-us.php', 'front.about-us')->name('about-us');
Route::view('contact.php', 'front.contact')->name('contact');
Route::view('experience.php', 'front.experience')->name('experience');
Route::get('gallery.php', [FrontController::class, 'gallery'])->name('gallery');
Route::get('offers.php', [FrontController::class, 'offers'])->name('offers');


// View::Composer(['partials.header','partials.footer'], function($view){
//     $view->with([
//         'settings'=>Setting::get(),
//     ]);
// });