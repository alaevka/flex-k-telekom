<?php

namespace App\Providers;

use App\Services\EquipmentServiceInterface;
use App\Services\EquipmentService;
use App\Services\EquipmentTypeService;
use App\Services\EquipmentTypeServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EquipmentServiceInterface::class, function () {
            return new EquipmentService();
        });
        $this->app->bind(EquipmentTypeServiceInterface::class, function () {
            return new EquipmentTypeService();
        });
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
}
