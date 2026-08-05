<?php

namespace App\Providers;

use App\Models\ContactPage;
use App\Models\Resort;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('front.partials.footer', function ($view) {
            $contactpage = ContactPage::first();
            $resorts = Resort::latest()->get();
            $view->with(['contactpage' => $contactpage, 'resorts' => $resorts,]);
        });
    }
}