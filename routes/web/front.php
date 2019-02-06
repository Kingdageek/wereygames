<?php

Route::match(['GET'], '/')
    ->name('front.index')
    ->uses('FrontController@index');
