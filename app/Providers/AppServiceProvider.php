<?php

namespace App\Providers;

use App\Services\SubmissionLogger;
use App\Repositories\V1\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\V1\CourseRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;
use App\Repositories\V1\AssignmentRepository;
use App\Repositories\V1\SubmissionRepository;
use App\Interfaces\AssignmentRepositoryInterface;
use App\Interfaces\SubmissionRepositoryInterface;

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
        $this->app->bind(AssignmentRepositoryInterface::class, AssignmentRepository::class);
        $this->app->bind(SubmissionRepositoryInterface::class, SubmissionRepository::class);
        $this->app->singleton(SubmissionLogger::class, function ($app) {
            return new SubmissionLogger();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
