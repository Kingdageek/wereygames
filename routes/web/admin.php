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

    Route::match(['GET', 'POST'], 'story/{id}/form')
        ->name('admin.story.form')
        ->uses('StoryController@storyForm');

    Route::match(['GET', 'POST'], 'story/{id}/form-update')
        ->name('admin.story.form.update')
        ->uses('StoryController@storyFormUpdate');

    Route::match(['GET'], 'story/{id}/delete')
        ->name('admin.story.delete')
        ->uses('StoryController@delete');

    Route::match(['GET'], 'users')
        ->name('admin.users')
        ->uses('UserController@index');

    Route::match(['GET', 'POST'], 'user/create')
        ->name('admin.user.create')
        ->uses('UserController@create');

    Route::match(['GET', 'POST'], 'user/{id}/edit')
        ->name('admin.user.edit')
        ->uses('UserController@edit');

    Route::match(['GET'], 'user/{id}/delete')
        ->name('admin.user.delete')
        ->uses('UserController@delete');

});
