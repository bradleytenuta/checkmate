<?php

Auth::routes();

// The login route and controller are already defined by default.
// If the user is logged in already, then they cannot access the login page and are
// redirected to the home page.
Route::get('/', function () { 
    return redirect()->route('login'); 
});

// Route to the home page.
Route::get('/home', 'HomeController@show')->name('home')->middleware('auth');

// Route to show a moudle.
Route::get('modules/{id}', 'ModuleController@show')->name('module.show')->middleware('auth');

// Route to show a coursework.
Route::get('courseworks/{id}', 'CourseworkController@show')->name('coursework.show')->middleware('auth');

// Route to show a user.
Route::get('users/{id}', 'UserController@show')->name('user.show')->middleware('auth');

// All the create routes
Route::get('create/module', 'CreateController@createModule')->name('create.module')->middleware('auth');