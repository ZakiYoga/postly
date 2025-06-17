<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Blade;

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

        Blade::directive('hexToRgba', function ($expression) {
            return "<?php echo \\App\\Helpers\\ColorHelper::hexToRgba($expression); ?>";
        });
    }
}
