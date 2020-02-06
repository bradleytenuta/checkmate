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
Route::get('modules/create', 'ModuleController@showCreateModule')->name('module.create.show')->middleware('auth');
Route::post('modules/create', 'ModuleController@createModule')->name('module.create')->middleware('auth');
Route::post('modules/edit', 'ModuleController@editModule')->name('module.edit')->middleware('auth');
Route::get('modules/edit/{id}', 'ModuleController@showEditModule')->name('module.edit.show')->middleware('auth');
Route::post('modules/delete/{id}', 'ModuleController@deleteModule')->name('module.delete')->middleware('auth');
Route::get('modules/{id}', 'ModuleController@show')->name('module.show')->middleware('auth');

// Coursework Routes
Route::post('courseworks/create', 'CourseworkController@createCoursework')->name('coursework.create')->middleware('auth');
Route::get('courseworks/create/{id}', 'CourseworkController@showCreateCoursework')->name('coursework.create.show')->middleware('auth');
Route::post('courseworks/edit', 'CourseworkController@editCoursework')->name('coursework.edit')->middleware('auth');
Route::get('courseworks/edit/{id}', 'CourseworkController@showEditCoursework')->name('coursework.edit.show')->middleware('auth');
Route::post('courseworks/delete/{id}', 'CourseworkController@deleteCoursework')->name('coursework.delete')->middleware('auth');
Route::get('courseworks/{id}', 'CourseworkController@show')->name('coursework.show')->middleware('auth');

// User Routes
Route::get('users/edit', 'UserController@showEditUser')->name('user.edit.show')->middleware('auth');
Route::post('users/edit', 'UserController@editUser')->name('user.edit')->middleware('auth');
Route::get('users/delete', 'UserController@showDeleteUser')->name('user.delete.show')->middleware('auth');
Route::post('users/delete', 'UserController@deleteUser')->name('user.delete')->middleware('auth');
Route::post('users/current/delete', 'UserController@deleteCurrentUser')->name('user.current.delete')->middleware('auth');
Route::get('users/{id}', 'UserController@show')->name('user.show')->middleware('auth');