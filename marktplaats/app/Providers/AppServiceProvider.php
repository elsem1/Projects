<?php

namespace App\Providers;

use App\Events\SuccessfulRegistration;
use App\Listeners\SendSuccessfulRegistration;
use App\View\Components\AdForm;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Blade;
use App\View\Components\CarouselSlide;
use App\View\Components\Carousel;
use Illuminate\Support\Facades\Gate;
use App\Policies\AdPolicy;
use App\Models\Ad;

use function Illuminate\Events\queueable;

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
    
        if (config('app.env') === 'local') 
        { 
            Mail::alwaysTo('your_test_email@mailtrap.io'); 
        }

    VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
        return (new MailMessage)
            ->subject('Verify Email Address')
            ->line('Click the button below to verify your email address.')
            ->action('Verify Email Address', $url);
    });
    
        Blade::component('carousel-slide', CarouselSlide::class);  
        Blade::component('carousel', Carousel::class);
        Gate::policy(Ad::class, AdPolicy::class);


    // view()->composer('*', function ($view) 
    // { 
    //     $currentViewName = $view->getName();
        
    //     if (in_array($currentViewName, ['welcome', '/', 'homepage']))
    //     {       
    //         return; 
    //     }


    //     $slides = collect(range(1, 3))->map(function ($i) { 
    //         return [ 
    //             'id' => $i, 
    //             'image' => "https://picsum.photos/400/400?random={$i}", 
    //             'title' => "Random Image {$i}", 
    //             'description' => "This is a description for Random Image {$i}", 
    //             'link' => '#', 'checked' => $i === 1 ]; 
    //         });
    //         $view->with('slides', $slides);
    //     });

    }    

}

