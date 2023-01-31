<?php

namespace App\Actions;

use Illuminate\Http\Request;
use App\Models\EquipmentType;
use App\Contracts\GetEquipmentTypesContract;
use App\Http\Resources\EquipmentTypeResource;

class GetEquipmentTypesAction implements GetEquipmentTypesContract
{
    public function __invoke(Request $request)
    {
        $per_page = config('equipment.equipment_types_per_page');
        $equipment_types = $request->q && $request->param
            ? EquipmentType::where($request->param, 'like', '%' . $request->q . '%')->paginate($per_page)
            : EquipmentType::paginate($per_page);

        return EquipmentTypeResource::collection($equipment_types);
    }
}