<?php

namespace Krutyosila\Wallet\Services;

use Krutyosila\Wallet\Models\WalletCycle;
use Krutyosila\Wallet\Models\WalletTransaction;
use Krutyosila\Wallet\Types\WalletTransactionType;

class WalletService
{
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_WITHDRAW = 'withdraw';
    const TYPE_BET = 'bet';
    const TYPE_WIN = 'win';
    const TYPE_BONUS = 'bonus';
    const CYCLE_TYPES = ['deposit', 'bet', 'bonus'];
    public function create(WalletTransactionType $types)
    {
        $wallet = $types->getWallet();
        if ($types->getType() == self::TYPE_WITHDRAW OR $types->getType() == self::TYPE_BET) {
            if ($types->getAmount() > $wallet->balance) {
                throw new \Exception(__('wallet::errors.insufficient_balance'));
            }
            $types->setAmount($types->getAmount() * -1);
            $wallet->balance = $wallet->balance + $types->getAmount();
            $wallet->save();
        }
        if (($types->getType() == self::TYPE_DEPOSIT OR $types->getType() == self::TYPE_WIN OR self::TYPE_BONUS) && $types->getConfirmed()) {
            $wallet->balance = $wallet->balance + $types->getAmount();
            $wallet->save();
        }
        $types->setTxn();
        if($types->getConfirmed()) {
            if (in_array($types->getType(), self::CYCLE_TYPES)) {
                $this->updateCycle($wallet->cycle, $types->getAmount());
            }
        }
        return $wallet->transactions()->create($types->getAll());
    }

    public function confirm(WalletTransaction $transaction)
    {
        if ($transaction->confirmed) {
            throw new \Exception(__('wallet::errors.transaction_was_confirmed'));
        }
        $wallet = $transaction->wallet;
        if ($transaction->type == self::TYPE_DEPOSIT) {
            $wallet->balance = $wallet->balance + $transaction->amount;
            $wallet->save();
            $this->updateCycle($wallet->cycle, $transaction->amount);
        }
        $transaction->confirmed = true;
        $transaction->save();
        return $transaction;
    }

    public function updateCycle(WalletCycle $cycle, $amount)
    {
        $next = $cycle->balance + $amount;
        $cycle->balance = $next < 0 ? 0 : $next;
        $cycle->save();
    }
}
