<?php

namespace App\Providers;

use App\Interfaces\AssignmentRepositoryInterface;
use App\Repositories\V1\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\V1\CourseRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\SubmissionRepositoryInterface;
use App\Repositories\V1\AssignmentRepository;
use App\Repositories\V1\SubmissionRepository;

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

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
