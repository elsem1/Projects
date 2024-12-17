<?php

namespace App\Providers;

use Illuminate\Support\Str;
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
use App\Models\Message;
use App\Policies\MessagePolicy;
use App\Events\NewMessage;
use App\Listeners\SendNewMessage;

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



        if (config('app.env') === 'local') {
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
        Gate::policy(Message::class, MessagePolicy::class);


        view()->composer(['ads.*', 'user.profile'], function ($view) {
            $slide = [];
            $usedImages = [];

            while (count($slide) < 16) {
                $randomImageUrl = "https://picsum.photos/400/400?random=" . Str::random(16);

                if (!in_array($randomImageUrl, $usedImages)) {
                    $slide[] = [
                        'id' => count($slide) + 1,
                        'image' => $randomImageUrl,
                        'title' => "Nice picture " . (count($slide) + 1),
                        'description' => "A picture for this nice product " . (count($slide) + 1),
                        'link' => '#',
                    ];
                    $usedImages[] = $randomImageUrl;
                }
            }

            $view->with('slide', $slide);
        });
    }
}
