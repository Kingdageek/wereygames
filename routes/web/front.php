<?php

Route::match(['GET'], '/')
    ->name('front.index')
    ->uses('FrontController@index');

Route::match(['GET'], '/about')
    ->name('front.about')
    ->uses('FrontController@about');

if ( ! \App\Models\Settings::first()->beta_mode ) {
    Route::match(['GET', 'POST'], '/play')
    ->name('story.play')
    ->middleware('guestUser')
    ->uses('StoryController@play');

    Route::get('/play-with-suggestions/{story}', 'StoryController@playWithSuggestions')
        ->middleware('guestUser')
        ->name('story.suggestionsPlay');

    Route::get('/game/get-hints', 'StoryController@getHints')
        ->middleware('guestUser')
        ->name('game.getHints');

    Route::match(['GET', 'POST'], '/unlock')
        ->name('story.unlock')
        ->middleware('guestUser')
        ->uses('StoryController@unlock');

    Route::match(['GET', 'POST'], '/stories')
        ->name('get.stories')
        ->middleware(['guestUser', 'unlocked'])
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
}
