<?php

namespace App\Contracts;

use App\Models\Equipment;

interface GetEquipmentContract
{
    public function __invoke(Equipment $equipment);
}