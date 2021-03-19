<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Api\Services\Post\IPostService;
use App\Api\Services\Post\PostService;
use App\Api\Services\Member\IMemberService;
use App\Api\Services\Member\MemberService;

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
        $this->app->bind(IMemberService::class, MemberService::class);
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
