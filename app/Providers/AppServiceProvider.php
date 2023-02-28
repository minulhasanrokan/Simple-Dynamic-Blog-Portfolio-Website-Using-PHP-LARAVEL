<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SystemSettings;

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
        $system_settings = SystemSettings::where("published_status", 1)
            ->where('delete_status',0)
            ->where("status_active", 1)
            ->first();

        // Using view composer to set following variables globally
        view()->composer('*',function($view) {

            $view->with('system_settings', SystemSettings::where("published_status", 1)
                ->where('delete_status',0)
                ->where("status_active", 1)
                ->first()
            ); 
        });
    }
}


