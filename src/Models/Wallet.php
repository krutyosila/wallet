<?php

namespace Krutyosila\Wallet\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

    protected $fillable = [
        'user_id', 'balance'
    ];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function cycle()
    {
        return $this->hasOne(WalletCycle::class);
    }
}
