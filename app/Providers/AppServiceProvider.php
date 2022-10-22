<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Two\IndeedProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    private function bootIndeedSocialite()
{
    $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
    $socialite->extend(
        'indeed',
        function ($app) use ($socialite) {
            $config = $app['config']['services.indeed'];
            return $socialite->buildProvider(IndeedProvider::class, $config);
        }
    );
}
}


