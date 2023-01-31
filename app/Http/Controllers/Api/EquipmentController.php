<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UpdateEquipmentContract;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Contracts\GetEquipmentsContract;
use App\Contracts\StoreEquipmentsContract;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Contracts\DestroyEquipmentContract;

class EquipmentController
{
    public function index(GetEquipmentsContract $action, Request $request)
    {
        return ($action)($request);
    }

    public function store(StoreEquipmentsContract $action, StoreEquipmentRequest $request)
    {
        return ($action)($request);
    }

    public function show(GetEquipmentsContract $action, Equipment $equipment)
    {
        return ($action)($equipment);
    }

    public function update(UpdateEquipmentContract $action, UpdateEquipmentRequest $request, Equipment $equipment)
    {
        return ($action)($request, $equipment);
    }

    public function destroy(DestroyEquipmentContract $action, Equipment $equipment)
    {
        return ($action)($equipment);
    }
}
