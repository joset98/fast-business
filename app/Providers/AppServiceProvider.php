<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Blade::directive('authadmin', function () {
            $admin = Auth::user()->role;
            info(fnmatch('{$admin}', 'ADMIN'));
            return "<?php if (! fnmatch('{$admin}', 'ADMIN') ) : ?>";
        });

        Blade::directive('endauthadmin', function ($expression) {
            return '<?php endif; ?>';
        });
    }
}
