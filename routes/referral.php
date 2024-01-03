<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/{affiliate_code}', function ($affiliate_code) {
        cookie('referral', $affiliate_code, 1000);
        return redirect('/');
    })->name('redirect');
})->middleware(['web', 'quest'])->prefix('referral')->as('referral.');
