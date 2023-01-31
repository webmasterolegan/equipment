<?php

namespace App\Actions;

use App\Contracts\DestroyEquipmentContract;
use App\Models\Equipment;

class DestroyEquipmentAction implements DestroyEquipmentContract
{
    public function __invoke(Equipment $equipment)
    {
        try {
            $equipment->delete();
            return response()->json(['success' => 'Оборудование успешно удалено']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }
    }
}