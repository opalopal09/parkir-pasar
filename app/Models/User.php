<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // =========================
    // TABLE & PRIMARY KEY
    // =========================
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    // =========================
    // MASS ASSIGNMENT
    // =========================
    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'role',
        'status_aktif'
    ];

    // =========================
    // HIDDEN FIELD
    // =========================
    protected $hidden = [
        'password',
    ];

    // =========================
    // CAST
    // =========================
    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    /**
     * Prevent automatic password hashing.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value;
    }
}
