<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function() {

    Route::match(['GET'], 'dashboard')
        ->name('admin.dashboard')
        ->uses('AdminController@dashboard');

    Route::match(['GET'], 'stories')
        ->name('admin.stories')
        ->uses('StoryController@index');

    Route::match(['GET', 'POST'], 'story/create')
        ->name('admin.story.create')
        ->uses('StoryController@create');

    Route::match(['GET', 'POST'], 'story/{id}/edit')
        ->name('admin.story.edit')
        ->uses('StoryController@edit');

    Route::match(['GET'], 'story/{id}/form')
        ->name('admin.story.form')
        ->uses('StoryController@storyForm');

});
