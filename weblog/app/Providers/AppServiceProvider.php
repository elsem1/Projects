<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;



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
        View::composer('*', function ($view) {
            $popularCategories = Category::withCount('articles')
                ->orderBy('articles_count', 'desc')
                ->take(4)
                ->get();
    
            $view->with('popularCategories', $popularCategories);
        });

        
    }
}
