<?php

namespace App\Actions;

use App\Contracts\GetEquipmentsContract;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Resources\EquipmentResource;

class GetEquipmentsAction implements GetEquipmentsContract
{
    public function __invoke(Request $request)
    {
        $per_page = config('equipment.equipments_per_page');
        $equipments = $request->q && $request->param
            ? Equipment::where($request->param, 'like', '%' . $request->q . '%')->paginate($per_page)
            : Equipment::paginate($per_page);

        return EquipmentResource::collection($equipments);
    }
}