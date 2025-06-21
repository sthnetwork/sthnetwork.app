<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'nama',
        'harga',
        'kecepatan',
        'keterangan'
    ];

    public $timestamps = true;

    // Relasi ke pelanggan jika ingin ditambah
    // public function customers()
    // {
    //     return $this->hasMany(Customer::class);
    // }
}

