<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Blade;
use Illuminate\Validation\Rules\Password;
use App\Services\PostViewService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PostViewService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            $rule = Password::min(8);

            return app()->environment('production')
                ? $rule->mixedCase()->numbers()->symbols()->uncompromised()
                : $rule;
        });

        Model::preventLazyLoading(false);

        Blade::directive('hexToRgba', function ($expression) {
            return "<?php echo \\App\\Helpers\\ColorHelper::hexToRgba($expression); ?>";
        });
    }
}
