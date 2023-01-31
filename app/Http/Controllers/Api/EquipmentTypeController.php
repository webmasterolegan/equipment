<?php

namespace App\Http\Controllers\Api;

use \Illuminate\Http\Request;
use App\Contracts\GetEquipmentTypesContract;

class EquipmentTypeController
{
    public function __invoke(GetEquipmentTypesContract $action, Request $request)
    {
        return ($action)($request);
    }
}
