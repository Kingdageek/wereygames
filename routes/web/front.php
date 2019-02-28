<?php

Route::match(['GET'], '/')
    ->name('front.index')
    ->uses('FrontController@index');

Route::match(['GET', 'POST'], '/play')
    ->name('story.play')
    ->middleware('guestUser')
    ->uses('StoryController@play');

Route::match(['GET', 'POST'], '/unlock')
    ->name('story.unlock')
    ->middleware('guestUser')
    ->uses('StoryController@unlock');

Route::match(['GET', 'POST'], '/stories')
    ->name('get.stories')
    ->middleware('guestUser')
    ->uses('StoryController@getStories');

Route::match(['GET'], '/story/{id}')
    ->name('story.select')
    ->middleware('guestUser')
    ->uses('StoryController@selectStory');

Route::match(['POST'], '/story/{id}')
    ->name('story.generate')
    ->middleware('guestUser')
    ->uses('StoryController@storyGenerate');

Route::match(['GET'], 'my/story/{slug}')
    ->name('story.preview')
    ->uses('FrontController@storyPreview');
