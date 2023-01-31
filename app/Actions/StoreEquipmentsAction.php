<?php

namespace App\Actions;

use App\Contracts\StoreEquipmentsContract;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;

class StoreEquipmentsAction implements StoreEquipmentsContract
{
    public function __invoke(StoreEquipmentRequest $request)
    {
        $response_data = [];

        if (!empty($request->equipment_with_errors)) {
            $response_data['errors'] = $request->equipment_with_errors;
        }

        foreach ($request->validated_equipments as $key => $validated_equipment) {
            try {
                $equipment = Equipment::create($validated_equipment);
                $response_data['success'][$key] = new EquipmentResource($equipment);
            } catch (\Exception $e) {
                $response_data['errors'][$key][] = $e->errorInfo[2];
            }
        }

        return response()->json($response_data);
    }
}