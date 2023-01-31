<?php

namespace App\Actions;

use App\Contracts\UpdateEquipmentContract;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;

class UpdateEquipmentAction implements UpdateEquipmentContract
{
    public function __invoke(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        $validated = $request->validated();

        $equipment->equipment_type_id = $validated['equipment_type_id'];
        $equipment->serial_number = $validated['serial_number'];
        $equipment->desc = $validated['desc'];

        try {
            $equipment->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }

        return response()->json(['success' => new EquipmentResource($equipment)]);
    }
}