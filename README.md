# laravel-referral

A Referral System With Laravel

## Installation

Via [Composer](https://getcomposer.org) to add the package to your project's dependencies:

```bash
composer require "webazin/referral @dev"
```

Publish the migrations

```bash
php artisan vendor:publish --provider="Questocat\Referral\ReferralServiceProvider" --tag="migrations"
```

Publish the config

```bash
$ php artisan vendor:publish --provider="Questocat\Referral\ReferralServiceProvider" --tag="config"
```

## Setup the model

Add UserReferral Trait to your User model.

```php
use Questocat\Referral\Traits\UserReferral

class User extends Model
{
    use UserReferral;
}
```

## Usage

Assigning CheckReferral Middleware To Routes.

```php
// Within App\Http\Kernel Class...

protected $routeMiddleware = [
    'referral' => \Questocat\Referral\Http\Middleware\CheckReferral::class,
];
```

Once the middleware has been defined in the HTTP kernel, you may use the middleware method to assign middleware to a route:

```php
Route::get('/', 'HomeController@index')->middleware('referral');
```

Now you can create the user:

```php
$user = new App\User();
$user->name = 'zhengchaopu';
$user->password = bcrypt('password');
$user->email = 'zhengchaopu@gmail.com';
$user->save();

// Or

$data = [
    'name' => 'zhengchaopu',
    'password' => bcrypt('password'),
    'email' => 'zhengchaopu@gmail.com',
];

App\User::create($data);
```

Get the referral link:

```php
$user = App\User::findOrFail(1);

{{ $user->getReferralLink() }}
```


## License

Licensed under the [MIT license](https://github.com/questocat/laravel-referral/blob/master/LICENSE).
