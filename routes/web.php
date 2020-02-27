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

// Module Routes
Route::get('modules/create', 'ModuleController@showCreateModule')->name('module.create.show')->middleware('auth');
Route::post('modules/create', 'ModuleController@createModule')->name('module.create')->middleware('auth');
Route::post('modules/edit', 'ModuleController@editModule')->name('module.edit')->middleware('auth');
Route::get('modules/all', 'ModuleController@showAll')->name('module.show.all')->middleware('auth');
Route::get('modules/edit/{module_id}', 'ModuleController@showEditModule')->name('module.edit.show')->middleware('auth');
Route::post('modules/delete/{module_id}', 'ModuleController@deleteModule')->name('module.delete')->middleware('auth');
Route::get('modules/{module_id}', 'ModuleController@show')->name('module.show')->middleware('auth');

// Coursework Routes
Route::post('modules/{module_id}/courseworks/create', 'CourseworkController@createCoursework')->name('coursework.create')->middleware('auth');
Route::get('modules/{module_id}/courseworks/create', 'CourseworkController@showCreateCoursework')->name('coursework.create.show')->middleware('auth');
Route::post('modules/{module_id}/courseworks/edit', 'CourseworkController@editCoursework')->name('coursework.edit')->middleware('auth');
Route::get('modules/{module_id}/courseworks/edit/{coursework_id}', 'CourseworkController@showEditCoursework')->name('coursework.edit.show')->middleware('auth');
Route::post('modules/{module_id}/courseworks/delete/{coursework_id}', 'CourseworkController@deleteCoursework')->name('coursework.delete')->middleware('auth');
Route::get('modules/{module_id}/courseworks/{coursework_id}', 'CourseworkController@show')->name('coursework.show')->middleware('auth');

// Test Routes
Route::post('modules/{module_id}/courseworks/{coursework_id}/test/upload', 'TestController@createTest')->name('test.create')->middleware('auth');
Route::get('modules/{module_id}/courseworks/{coursework_id}/test/upload', 'TestController@showCreateTest')->name('test.create.show')->middleware('auth');
Route::post('modules/{module_id}/courseworks/{coursework_id}/test/delete/{test_id}', 'TestController@deleteTest')->name('test.delete')->middleware('auth');

// Submission Routes
// TODO: Update to include coursework id.
// TOOD: move to submission controller.
Route::post('modules/{module_id}/courseworks/submission/upload', 'CourseworkController@storeSubmission')->name('coursework.submission.upload')->middleware('auth');

// User Routes
Route::get('users/edit/{user_id}', 'UserController@showEditUser')->name('user.edit.show')->middleware('auth');
Route::post('users/edit/{user_id}', 'UserController@editUser')->name('user.edit')->middleware('auth');
Route::get('users/all', 'UserController@showAll')->name('user.show.all')->middleware('auth'); // TODO: Change to view all users.
Route::post('users/delete/{user_id}', 'UserController@deleteUser')->name('user.delete')->middleware('auth');
Route::get('users/{user_id}', 'UserController@show')->name('user.show')->middleware('auth');