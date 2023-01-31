<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface GetEquipmentTypesContract
{
    public function __invoke(Request $request);
}