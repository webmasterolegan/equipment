<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use App\Utilities\ValidateSerialNumberById;

class SerialNumber implements InvokableRule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function __invoke($attribute, $value, $fail)
    {
        if (!ValidateSerialNumberById::validate($this->data['equipment_type_id'], $value)) {
            $fail('Серийный номер ' . $value . ' не соответствует маске типа оборудования ' . $this->data['equipment_type_id']);
        }
    }
}
