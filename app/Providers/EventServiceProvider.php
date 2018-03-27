<?php

namespace App\Providers;

use Illuminate\Support\Facades\session;
use Illuminate\Foundation\Support\Providers\sessionServiceProvider as ServiceProvider;

class sessionServiceProvider extends ServiceProvider
{
    /**
     * The session listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\sessions\session' => [
            'App\Listeners\sessionListener',
        ],
    ];

    /**
     * Register any sessions for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
