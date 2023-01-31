<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface GetEquipmentsContract
{
    public function __invoke(Request $request);
}