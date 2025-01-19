<?php

namespace App\Providers;

use App\Service\Bobot\BobotService;
use App\Service\Contract\BobotServiceInterface;
use App\Service\Contract\JawabanSeriviceInterface;
use App\Service\Contract\KriteriaServiceInterface;
use App\Service\Jawaban\JawabanService;
use App\Service\Krieria\KriteriaService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public $singletons = [
        BobotServiceInterface::class => BobotService::class,
        KriteriaServiceInterface::class => KriteriaService::class,
        JawabanSeriviceInterface::class => JawabanService::class
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
