<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191); //NEW: Increase StringLength

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\TaskRepositoryInterface',
            'App\Repositories\TaskRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ButtonRepositoryInterface',
            'App\Repositories\ButtonRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\FlowRepositoryInterface',
            'App\Repositories\FlowRepository'
        );
    }
}
