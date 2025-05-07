<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Facade as Avatar;

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
        Model::preventLazyLoading(false);

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $name = strtoupper($user->name);
                $avatarUrl = $user->avatar
                    ? asset('storage/' . $user->avatar)
                    : Avatar::create($name)->toBase64();

                $view->with('avatarUrl', $avatarUrl);
            }
        });
    }
}
