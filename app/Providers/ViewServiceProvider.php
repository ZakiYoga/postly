<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Inject categories ke semua view
        View::composer('*', function ($view) {
            $categories = Cache::remember('categories.all', now()->addHours(12), function () {
                return Category::all();
            });

            $view->with('categories', $categories);
        });
    }

    public function register(): void
    {
        //
    }
}