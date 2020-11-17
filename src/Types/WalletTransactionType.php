<?php

namespace Krutyosila\Wallet\Types;

use Krutyosila\Wallet\Models\Wallet;

class WalletTransactionType
{
    public $wallet;
    public $type;
    public $intermediary;
    public $amount;
    public $meta;
    public $confirmed;

    /**
     * @param Wallet $wallet
     */
    public function setWallet($wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * @return Wallet
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getIntermediary()
    {
        return $this->intermediary;
    }

    /**
     * @param string $intermediary
     */
    public function setIntermediary($intermediary)
    {
        $this->intermediary = $intermediary;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param array $meta
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @return boolean
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @param boolean $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return (array) $this;
    }
}
