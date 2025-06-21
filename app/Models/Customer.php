<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'no_hp',
        'alamat',
        'mikrotik_id',
        'cluster',
        'paket',
        'harga_paket',
        'username_pppoe',
        'password_pppoe',
        'onu_serial',
        'status',
    ];

    public function mikrotik()
    {
        return $this->belongsTo(Mikrotik::class);
    }
}

