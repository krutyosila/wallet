<?php

namespace Krutyosila\Wallet\Services;

use Krutyosila\Wallet\Models\WalletTransaction;
use Krutyosila\Wallet\Types\WalletTransactionType;

class WalletService
{
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_WITHDRAW = 'withdraw';

    public function create(WalletTransactionType $types)
    {
        $wallet = $types->getWallet();
        if ($types->getType() == self::TYPE_WITHDRAW) {
            if ($types->getAmount() > $wallet->balance) {
                throw new \Exception(__('wallet::errors.insufficient_balance'));
            }
            $types->setAmount($types->getAmount() * -1);
            $wallet->balance = $wallet->balance + $types->getAmount();
            $wallet->save();
        }
        if ($types->getType() == 'deposit' && $types->getConfirmed()) {
            $wallet->balance = $wallet->balance + $types->getAmount();
            $wallet->save();
        }
        $types->setTxn($wallet->id);
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
        }
        $transaction->confirmed = true;
        $transaction->save();
        return $transaction;
    }
}
