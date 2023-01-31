<?php

namespace App\Http\Requests;

use App\Models\EquipmentType;
use App\Models\Equipment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use App\Utilities\ValidateSerialNumberById;

class StoreEquipmentRequest extends FormRequest
{
    public $equipment_with_errors = [];
    public $validated_equipments = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //'*' => 'array:equipment_type_id,serial_number,desc'
        ];
    }

    protected function prepareForValidation()
    {
        // ID существующих типов оборудования
        $equipment_type_ids = EquipmentType::pluck('id')->toArray();

        foreach ($this->request->all() as $key => $equipment) {
            // Если в массиве нет нужных ключей то пропускаем дальнейшую логику итерации
            if (!array_key_exists('equipment_type_id', $equipment)
                || !array_key_exists('serial_number', $equipment)
                || gettype($equipment['equipment_type_id']) !== 'integer'
                || gettype($equipment['serial_number']) !== 'string'
            ) {
                $this->equipment_with_errors[$key][] = 'Не корректный массив';
                continue;
            }

            // Проверка на существование типа оборудования
            if (!in_array($equipment['equipment_type_id'], $equipment_type_ids)) {
                $this->equipment_with_errors[$key][] = 'Неизвестный ID (' . $equipment['equipment_type_id'] . ') типа оборудования';
            } else {
                // Проверка на существование дубликата по типу и серийному номеру
                $isset_equipments = Equipment::whereSerialNumber($equipment['serial_number'])
                    ->whereEquipmentTypeId($equipment['equipment_type_id'])
                    ->count();
                if ($isset_equipments > 0) {
                    $this->equipment_with_errors[$key][] = 'Оборудование с таким типом (' . $equipment['equipment_type_id']
                    . ') и серийным номером (' . $equipment['serial_number'] . ') уже существует';
                }
            }

            // Проверка серийного номера по маске
            if (!ValidateSerialNumberById::validate($equipment['equipment_type_id'], $equipment['serial_number'])) {
                $this->equipment_with_errors[$key][] = 'Серийный номер (' . $equipment['serial_number']
                . ') не соответствует маске типа (' . $equipment['equipment_type_id'] . ')';
            }

            // Проверка корректности описания (desc), если имеет значение
            if (isset($equipment['desk']) && gettype($equipment['desk']) !== 'string') {
                $this->equipment_with_errors[$key][] = 'Значение desc должно быть строкой или NULL';
            }

            // Формирование массива данных оборудования, прошедших проверку
            if (!array_key_exists($key, $this->equipment_with_errors)) {
                $this->validated_equipments[$key] = Arr::only($equipment, [
                    'equipment_type_id',
                    'serial_number',
                    'desc'
                ]);
            }
        }
    }
}
