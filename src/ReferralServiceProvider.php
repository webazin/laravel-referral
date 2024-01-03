<?php

namespace Webazin\Referral;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class ReferralServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/referral.php');
    }
}
