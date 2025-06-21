<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Mikrotik extends Model
{
    protected $fillable = [
        'router_name',
        'ip_address',
        'port_api',
        'username',
        'password',
        'cluster',
        'site_type',
        'status'
    ];

    public $timestamps = true;

    // Enkripsi password otomatis saat disimpan
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Crypt::encryptString($value);
    }

    // Dekripsi otomatis saat digunakan
    public function getPasswordAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    // Relasi ke pelanggan (jika ada)
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    // Relasi ke akun VPN
    public function vpnAccounts()
    {
        return $this->hasMany(VpnAccount::class);
    }
}

