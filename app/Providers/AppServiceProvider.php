<?php

namespace App\Providers;

use App\Service\Bobot\BobotService;
use App\Service\Contract\BobotServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public $singletons = [
        BobotServiceInterface::class => BobotService::class
    ];

    
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
        //
    }
}
