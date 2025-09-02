<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Doctrine\DBAL\Types\Type;

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
        if (!Type::hasType('enum')) {
        Type::addType('enum', 'Doctrine\DBAL\Types\StringType');
    }

    if (!Type::hasType('set')) {
        Type::addType('set', 'Doctrine\DBAL\Types\StringType');
    }
    }
}
