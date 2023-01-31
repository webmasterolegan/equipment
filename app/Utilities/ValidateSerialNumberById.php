<?php

namespace App\Utilities;

use App\Models\EquipmentType;

class ValidateSerialNumberById
{
    public static function validate(int $equipment_type_id, string $serial_number) : bool
    {
        // Посимвольные регулярные выражения для масок
        $reles = config('equipment.equipment_type_serial_number_rules');

        // Преобразование в массивы символов, для удобства обработки
        $mask = str_split(EquipmentType::whereId($equipment_type_id)->pluck('mask')->first());
        $serial_number = str_split($serial_number);

        // Проверка на соответсвие длинны
        if (count($mask) !== count($serial_number)) return false;

        // Посимвольная проверка регулярными выражениями
        foreach ($serial_number as $key => $simbol) {
            $simbol_valid = (preg_match('/' . $reles[$mask[$key]] . '/', $simbol));
            if (!$simbol_valid) return false;
        }

        return true;
    }
}