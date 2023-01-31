<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\EquipmentType;
use App\Rules\SerialNumber;

class UpdateEquipmentRequest extends FormRequest
{
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
        $equipment_type_ids = EquipmentType::pluck('id')->toArray();

        return [
            'equipment_type_id' => [
                'required',
                'integer',
                Rule::in($equipment_type_ids)
            ],
            'serial_number' => [
                'required',
                'string',
                new SerialNumber,
            ],
            'desc' => [
                'string',
                'nullable'
            ]
        ];
    }
}
