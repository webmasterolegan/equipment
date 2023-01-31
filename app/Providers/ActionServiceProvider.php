<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Actions\GetEquipmentTypesAction;
use App\Contracts\GetEquipmentTypesContract;
use App\Actions\GetEquipmentsAction;
use App\Contracts\GetEquipmentsContract;
use App\Actions\StoreEquipmentsAction;
use App\Contracts\StoreEquipmentsContract;
use App\Contracts\UpdateEquipmentContract;
use App\Actions\UpdateEquipmentAction;
use App\Actions\DestroyEquipmentAction;
use App\Contracts\DestroyEquipmentContract;

class ActionServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public $bindings = [
        GetEquipmentContract::class => GetEquipmentAction::class,
        GetEquipmentTypesContract::class => GetEquipmentTypesAction::class,
        GetEquipmentsContract::class => GetEquipmentsAction::class,
        StoreEquipmentsContract::class => StoreEquipmentsAction::class,
        UpdateEquipmentContract::class => UpdateEquipmentAction::class,
        DestroyEquipmentContract::class => DestroyEquipmentAction::class,
    ];

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            GetEquipmentContract::class,
            GetEquipmentTypesContract::class,
            GetEquipmentsContract::class,
            StoreEquipmentsContract::class,
            UpdateEquipmentContract::class,
            DestroyEquipmentContract::class,
        ];
    }
}
