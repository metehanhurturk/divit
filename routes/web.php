<?php

use Divit\Models\Project;

Route::get('/zed', function () {
    factory(Project::class, 10)->create();
});

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'projects'], function () {
    Route::get('/', 'ProjectsController@index')->name('projects.index');
    Route::get('/create', 'ProjectsController@create')->name('projects.create');
    Route::get('/{project}', 'ProjectsController@show')->name('projects.show');
    Route::get('/{project}/edit', 'ProjectsController@edit')->name('projects.edit');
    Route::post('/', 'ProjectsController@store')->name('projects.store');
    Route::patch('/{project}', 'ProjectsController@update')->name('projects.update');

    Route::get('/{project}/tasks', 'ProjectTasksController@index')->name('tasks.index');
    Route::post('/{project}/tasks', 'ProjectTasksController@store')->name('tasks.store');
    Route::patch('/{project}/tasks/{task}', 'ProjectTasksController@update')->name('tasks.update');
});
