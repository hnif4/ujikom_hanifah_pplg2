<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Galery;

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
        View::composer('layouts.partials.footer', function ($view) {
            $frontend_galeries = Galery::with(['photos' => function($query) {
                $query->limit(4);
            }])->get();
            
            $view->with('frontend_galeries', $frontend_galeries);
        });
    }
}
