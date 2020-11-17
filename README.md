### Laravel Simple Wallet


Installation
-
``` 
composer require krutyosila/wallet
```

config/app.php
```
'providers' => [
...
    \Krutyosila\Wallet\WalletServiceProvider
...
];
```
```
php artisan vendor:publish --tag=wallet-migrations
```

Usage
-
Add WalletTrait to Users Model
```
use Krutyosila\Wallet\Traits\WalletTrait

class User exteds Model
{
    use WalletTrait;
    ...
```

RegisterController.php
```
protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);
    $user->wallet()->create();
    return $user;
}
```

**Add**
```
$intermediary = 'Bank';
$amount = 10.50;
$user->deposit($intermediary, $amount);
//or
$user->withdraw($intermediary, $amount);
```
**Meta**
```
$intermediary = 'Bank';
$amount = 10.50;
$meta = [
    'hello' => 'world',
];
$user->deposit($intermediary, $amount, $meta);
//or
$user->withdraw($intermediary, $amount, $meta);
```

**Confirmed**
```
$intermediary = 'Bank';
$amount = 10.50;
$meta = [
    'hello' => 'world',
];
$confirmed = false;
$user->deposit($intermediary, $amount, $meta, $confirmed);
//or
$user->withdraw($intermediary, $amount, $meta, $confirmed);
```
**Confirm Transaction**
```
$transaction = $user->transactions()->where('confirmed',0)->first();
$user->confirm($transaction);
```
Details
-
```
// User transactions
$user->transactions;
// User Wallet
$user->wallet;
// User Balance
$user->wallet->balance;
```
