<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraans';

    protected $fillable = [
        'plat_nomor',
        'jenis',
        'warna',
        'pemilik',
        'id_tarif',
        'id_area',
        'waktu_keluar',
        'total_biaya',
        'status',
    ];

    // Relationship to Tarif
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }

    // Relationship to Area
    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area', 'id');
    }
}
