<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EquipmentType;

class EquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipment_types = [
            [
                'name' => 'TP-Link TL-WR74',
                'mask' => 'XXAAAAAXAA'
            ],[
                'name' => 'D-Link Dir-300',
                'mask' => 'NXXAAXZXaa'
            ],[
                'name' => 'D-Link DIR-300 E',
                'mask' => 'NAAAAXZXXX'
            ],
        ];

        foreach ($equipment_types as $equipment_type) {
            $equipment_type = EquipmentType::create($equipment_type);
        }
    }
}
