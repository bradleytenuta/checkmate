<?php
/**
 * Routes with '{tag}' should appear at the bottom of its list. 
 * This is because laravel will consider it for any url.
 */

// Auth Routes
Auth::routes();

// Root url is the login page.
Route::get('/', function () { 
    return redirect()->route('login'); 
});

// Route to the home page.
Route::get('/home', 'HomeController@show')->name('home')->middleware('auth');

// Moudle Routes
Route::get('modules/create', 'ModuleController@showModuleForm')->name('module.create.showModuleForm')->middleware('auth');
Route::post('modules/create', 'ModuleController@createModule')->name('module.create')->middleware('auth');
Route::get('modules/{id}', 'ModuleController@show')->name('module.show')->middleware('auth');

// Route to show a coursework.
Route::get('courseworks/{id}', 'CourseworkController@show')->name('coursework.show')->middleware('auth');

// Route to show a user.
Route::get('users/{id}', 'UserController@show')->name('user.show')->middleware('auth');