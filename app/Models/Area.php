<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'area';

    protected $fillable = [
        'nama_area',
        'kapasitas_motor',
        'kapasitas_mobil',
        'status',
    ];
}
