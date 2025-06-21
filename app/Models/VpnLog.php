<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpnLog extends Model
{
    protected $fillable = ['vpn_account_id', 'action', 'ip_address'];

    public function vpnAccount()
    {
        return $this->belongsTo(VpnAccount::class);
    }
}

