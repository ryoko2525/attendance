<?php

namespace App\Providers;

use Laravel\Fortify\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            'App\Listeners\RedirectAfterRegistration',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // ユーザー登録後のイベントリスナー
        \Illuminate\Support\Facades\Event::listen(Registered::class, function ($event) {
            return Redirect::to('/login');
        });
    }
}
