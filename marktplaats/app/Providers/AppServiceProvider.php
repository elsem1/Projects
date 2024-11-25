<?php

namespace App\Providers;

use App\Events\SuccessfulRegistration;
use App\Listeners\SendSuccessfulRegistration;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Blade;
use App\View\Components\CarouselSlide;

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
    
    }    

}

