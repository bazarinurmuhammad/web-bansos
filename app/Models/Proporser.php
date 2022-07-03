<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proporser extends Model
{
    use HasFactory;

    protected $fillable = [
        'rt_id',
        'rw_id',
        'income_id',
        'nik',
        'kk',
        'name',
        'province',
        'regency',
        'district',
        'village',
        'address',
        'phone',
        'photo',
        'latitude',
        'longitude'
    ];
}
