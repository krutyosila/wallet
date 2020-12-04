<?php

namespace Krutyosila\Wallet\Traits;

use Krutyosila\Wallet\Models\Wallet;
use Krutyosila\Wallet\Services\WalletService;
use Krutyosila\Wallet\Types\WalletTransactionType;

trait WalletTrait
{
    public function deposit($intermediary, $amount, $meta = [], $confirmed = 1)
    {
        $types = new WalletTransactionType();
        $types->setType(WalletService::TYPE_DEPOSIT);
        $types->setIntermediary($intermediary);
        $types->setAmount($amount);
        $types->setMeta($meta);
        $types->setConfirmed($confirmed);
        $types->setWallet($this->wallet);
        return app(WalletService::class)->create($types);
    }

    public function withdraw($intermediary, $amount, $meta = [], $confirmed = 1)
    {
        $types = new WalletTransactionType();
        $types->setType(WalletService::TYPE_WITHDRAW);
        $types->setIntermediary($intermediary);
        $types->setAmount($amount);
        $types->setMeta($meta);
        $types->setConfirmed($confirmed);
        $types->setWallet($this->wallet);
        return app(WalletService::class)->create($types);
    }

    public function transaction($type, $intermediary, $amount, $meta = [])
    {
        if(!in_array($type, [WalletService::TYPE_BET, WalletService::TYPE_WIN])) {
            return false;
        }
        $types = new WalletTransactionType();
        $types->setType($type);
        $types->setIntermediary($intermediary);
        $types->setAmount($amount);
        $types->setMeta($meta);
        $types->setConfirmed(1);
        $types->setWallet($this->wallet);
        return app(WalletService::class)->create($types);
    }

    public function confirm($transaction)
    {
        return app(WalletService::class)->confirm($transaction);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function transactions()
    {
        return $this->wallet->transactions();
    }
}
