<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Krutyosila\Wallet\Models\Wallet;

class WalletCycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id', 'balance'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
