<?php

namespace App\Providers;

use App\Models\Category;
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
        // Share categories globally with all views
        View::composer('*', function ($view) {
            $view->with('navCategories', Category::where('is_active', true)->orderBy('sort_order')->take(6)->get());
        });
    }
}
