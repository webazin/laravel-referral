<?php

use Illuminate\Support\Facades\Route;

Route::get('referral/{affiliate_code}', function ($affiliate_code) {
    return redirect('/')->withCookie(cookie('referral', $affiliate_code,1000));
})->name('referral.redirect')->middleware(['web', 'guest']);
