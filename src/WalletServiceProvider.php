<?php

namespace Krutyosila\Wallet;

use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'wallet');
        $this->publishes([
            __DIR__ . '/config/wallet.php' => config_path('wallet.php'),
        ], 'wallet-config');
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations'),
        ], 'wallet-migrations');

    }

    public function register()
    {
    }
}
