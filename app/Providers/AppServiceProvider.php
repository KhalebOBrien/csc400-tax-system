<?php

namespace App\Providers;

use Illuminate\Support\Number;
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
        // Add a custom macro to the Number class
        Number::macro('random', function (int $length) {
            if ($length < 1) {
                throw new \InvalidArgumentException('Length must be greater than or equal to 1.');
            }

            $min = (int) str_repeat('1', $length);
            $max = (int) str_repeat('9', $length);

            return random_int($min, $max);
        });
    }
}
