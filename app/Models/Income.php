<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable =[
        'name'
    ];

    public function proporser()
    {
        return $this->hasOne(Proporser::class, 'income_id');
    }
}
