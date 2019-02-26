<?php

Route::match(['GET'], '/')
    ->name('front.index')
    ->uses('FrontController@index');

Route::match(['GET', 'POST'], '/start')
    ->name('front.start')
    ->uses('FrontController@start');

Route::match(['GET', 'POST'], '/stories')
    ->name('front.stories')
    ->uses('FrontController@stories');

Route::match(['POST'], '/story/{id}')
    ->name('story.generate')
    ->uses('FrontController@storyGenerate');

Route::match(['GET'], '/story/preview')
    ->name('story.preview')
    ->uses('FrontController@storyPreview');
