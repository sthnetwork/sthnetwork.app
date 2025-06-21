<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpnAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'mikrotik_id',
        'username',
        'password',
        'ip_address',
        'vpn_type',
        'script',
        'status',
    ];

    // Relasi ke Mikrotik
    public function mikrotik()
    {
        return $this->belongsTo(Mikrotik::class);
    }
}

