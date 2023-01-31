<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'mask',
    ];

    public function equipments()
    {
        return $this->hasMany(Equipmen::class);
    }
}
