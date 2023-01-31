<?php

namespace App\Contracts;

use App\Http\Requests\StoreEquipmentRequest;

interface StoreEquipmentsContract
{
    public function __invoke(StoreEquipmentRequest $request);
}