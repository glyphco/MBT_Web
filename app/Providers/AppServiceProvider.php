<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('has', function ($option) {
            $attributes = Request::instance()->query('user_data')['attributes'];
            if (in_array($option, $attributes)) {
                return "<?php if (true) : ?>";
            }
            return "<?php if (false) : ?>";
        });
        \Blade::directive('endhas', function ($options) {
            return "<?php endif; // Entrust::can ?>";
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
