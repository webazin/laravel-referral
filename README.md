# laravel-referral

A Referral System With Laravel

## Installation

Via [Composer](https://getcomposer.org) to add the package to your project's dependencies:

```bash
composer require "webazin/referral @dev"
```

migrations

```bash
 php artisan migrate
```

## Setup the model

Add ReferralTrait Trait to your User model.

```php
use Webazin\Referral\ReferralTrait

class User extends Model
{
    use ReferralTrait;
}
```

## Params

```php
App\User::find(1)->getRefLink();

App\User::find(1)->setParentId($referralCode);
App\User::find(1)->getParent();

App\User::find(1)->setReferralCode();
// if this set --- set parent id 
App\User::find(1)->getReferralCodeFromCookie();

```

## License

Licensed under the [MIT license](https://github.com/questocat/laravel-referral/blob/master/LICENSE).
