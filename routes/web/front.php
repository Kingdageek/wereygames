<?php

Route::match(['GET'], '/')
    ->name('front.index')
    ->uses('FrontController@index');

Route::match(['GET', 'POST'], '/start')
    ->name('front.start')
    ->uses('FrontController@start');
