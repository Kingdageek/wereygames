<?php

Route::match(['GET', 'POST'], '/auth/logout')
    ->name('auth.logout')
    ->uses('Auth\LoginController@logout');

// Auth::routes();

Auth::routes(['register' => false]);
