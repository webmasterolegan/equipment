<?php

namespace App\Contracts;

use App\Models\Equipment;

interface DestroyEquipmentContract
{
    public function __invoke(Equipment $equipment);
}