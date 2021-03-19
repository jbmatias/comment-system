<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Api\Services\Post\IPostService;
use App\Api\Services\Post\PostService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IPostService::class, PostService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
