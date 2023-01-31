<?php

namespace App\Actions;

use App\Http\Resources\EquipmentResource;
use App\Contracts\GetEquipmentContract;
use App\Models\Equipment;

class GetEquipmentsAction implements GetEquipmentContract
{
    public function __invoke(Equipment $equipment)
    {
        return new EquipmentResource($equipment);
    }
}