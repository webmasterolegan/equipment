<?php

namespace App\Contracts;

use App\Http\Requests\UpdateEquipmentRequest;
use App\Models\Equipment;

interface UpdateEquipmentContract
{
    public function __invoke(UpdateEquipmentRequest $request, Equipment $equipment);
}