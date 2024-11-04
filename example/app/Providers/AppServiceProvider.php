<?php

namespace App\Providers;



use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        Gate::define('edit-job', function (User $user, Job $job) // Gate is zoals het impliceerd, iets dat je tegen kan houden zonder auth
        {
            return $job->employer->user->is($user); // is is een method in models en kijkt of de twee gelijk aan elkaar zijn, isNot is het tegenovergestelde           
        });
    }
}
