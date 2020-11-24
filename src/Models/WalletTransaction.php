<?php

namespace Krutyosila\Wallet\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'wallet_id', 'txn', 'type', 'intermediary', 'amount', 'confirmed', 'meta'
    ];

    protected $casts = [
        'meta' => 'object'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
