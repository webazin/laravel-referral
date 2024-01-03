<?php

namespace App\Webazin\Referral;

use Illuminate\Support\ServiceProvider;

class ReferralServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '../routes/referral.php');
    }
}
