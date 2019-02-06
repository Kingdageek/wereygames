<?php

require __DIR__ . '/web/front.php';
require __DIR__ . '/web/auth.php';
require __DIR__ . '/web/admin.php';

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
