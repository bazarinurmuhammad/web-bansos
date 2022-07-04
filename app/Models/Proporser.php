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
        'status',
        'latitude',
        'longitude'
    ];

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id');
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id');
    }

    public function income()
    {
        return $this->belongsTo(Income::class, 'income_id');
    }
}
