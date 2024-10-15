<?php

namespace App\Providers;


use App\Repositories\V1\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\V1\CourseRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
