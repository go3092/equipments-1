<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      require_once base_path().'/app/Helpers/ResponHelpers.php';
      require_once base_path().'/app/Helpers/TimeHelpers.php';

    }
}
