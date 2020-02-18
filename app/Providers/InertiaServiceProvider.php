<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });



        Inertia::share('auth.user', function () {
            if (Auth::user()) {
                return [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ];
            }
        });

        Inertia::share([
            'app' => [ ],
            'flash' => [
                'success' => function() { return Session::get('success'); },
                'alert' => function() { return Session::get('alert'); },
                'message' => function() { return Session::get('message'); },
            ],

        ]);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
