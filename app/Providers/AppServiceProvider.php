<?php

namespace App\Providers;

use Modules\Shipment\Services\GeolocationService;
use Illuminate\Support\ServiceProvider;
use Modules\Authentication\Interfaces\AuthServiceInterface;
use Modules\Authentication\Interfaces\UserRepositoryInterface;
use Modules\Shipment\Repositories\ShipmentRepository;
use Modules\Authentication\Repositories\UserRepository;
use Modules\Authentication\Services\AuthService;
use Modules\Monitor\Interfaces\MonitoringServiceInterface;
use Modules\Monitor\Interfaces\SystemLogRepositoryInterface;
use Modules\Monitor\Repositories\SystemLogRepository;
use Modules\Monitor\Services\MonitoringService;
use Modules\Shipment\Interfaces\GeolocationServiceInterface;
use Modules\Shipment\Interfaces\ShipmentRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ShipmentRepositoryInterface::class, ShipmentRepository::class);
        $this->app->bind(GeolocationServiceInterface::class, GeolocationService::class);
        $this->app->bind(SystemLogRepositoryInterface::class,SystemLogRepository::class);
        $this->app->bind(MonitoringServiceInterface::class,MonitoringService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
