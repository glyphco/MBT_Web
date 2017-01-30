<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * Bade to start the "if block" on has($option).
         *
         * Will accept root attributes:
         * "venues-edit"
         * or model attributes
         * "venue.12.edit"
         *
         * NOTE: model attributes are automatically changed to the "adult" version
         * ie: "venue.12.edit"
         * becomes:
         * "venue.12.edit" or "venues-edit"
         */
        \Blade::directive('has', function ($option) {
            $rootpermission = 'forgetit';
            $pieces         = explode(".", $option);
            if (array_key_exists(2, $pieces)) {
                $rootpermission = $pieces[0] . "s-" . $pieces[2];
            }

            return '<?php
                $attributes = Request::instance()->query("user_data")["attributes"];
                $value      = ((array_get($attributes, "' . $option . '", false)) || (array_get($attributes, "' . $rootpermission . '", false)));

                if($value) :

                ?>';
        });

        \Blade::directive('endhas', function ($options) {
            return "<?php endif; // ?>";
        });

        \Blade::directive('truncate', function ($expression) {

            list($string, $length) = explode(',', str_replace(['(', ')', ' '], '', $expression));

            return "<?php echo e(strlen({$string}) > {$length} ? substr({$string},0,{$length}).'...' : {$string}); ?>";
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
