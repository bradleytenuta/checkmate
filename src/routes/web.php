<?php
/*
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
Route::get('modules/{module_id}/edit', 'ModuleController@showEditModule')->name('module.edit.show')->middleware('auth');
Route::post('modules/{module_id}/delete', 'ModuleController@deleteModule')->name('module.delete')->middleware('auth');
Route::get('modules/{module_id}', 'ModuleController@show')->name('module.show')->middleware('auth');

// Coursework Routes
Route::post('modules/{module_id}/courseworks/create', 'CourseworkController@createCoursework')->name('coursework.create')->middleware('auth');
Route::get('modules/{module_id}/courseworks/create', 'CourseworkController@showCreateCoursework')->name('coursework.create.show')->middleware('auth');
Route::post('modules/{module_id}/courseworks/edit', 'CourseworkController@editCoursework')->name('coursework.edit')->middleware('auth');
Route::get('modules/{module_id}/courseworks/{coursework_id}/edit/', 'CourseworkController@showEditCoursework')->name('coursework.edit.show')->middleware('auth');
Route::post('modules/{module_id}/courseworks/{coursework_id}/delete', 'CourseworkController@deleteCoursework')->name('coursework.delete')->middleware('auth');
Route::get('modules/{module_id}/courseworks/{coursework_id}', 'CourseworkController@show')->name('coursework.show')->middleware('auth');

// Test Routes
Route::post('modules/{module_id}/courseworks/{coursework_id}/test/upload', 'TestController@createTest')->name('test.create')->middleware('auth');
Route::get('modules/{module_id}/courseworks/{coursework_id}/test/upload', 'TestController@showCreateTest')->name('test.create.show')->middleware('auth');
Route::post('modules/{module_id}/courseworks/{coursework_id}/test/{test_id}/delete', 'TestController@deleteTest')->name('test.delete')->middleware('auth');

// Submission Routes
Route::post('modules/{module_id}/courseworks/{coursework_id}/submission/upload', 'SubmissionController@createSubmission')->name('submission.create')->middleware('auth');

// Viewer Routes
Route::post('modules/{module_id}/courseworks/{coursework_id}/submission/{submission_id}/save', 'ViewerController@saveMark')->name('viewer.mark.save')->middleware('auth');
Route::get('modules/{module_id}/courseworks/{coursework_id}/submission/{submission_id}/mark', 'ViewerController@showMark')->name('viewer.mark')->middleware('auth');
Route::get('modules/{module_id}/courseworks/{coursework_id}/submission/{submission_id}/studentview', 'ViewerController@showStudent')->name('viewer.student')->middleware('auth');
Route::get('modules/{module_id}/courseworks/{coursework_id}/test/{test_id}', 'ViewerController@showTest')->name('viewer.test')->middleware('auth');

// User Routes
Route::get('users/all', 'UserController@showAll')->name('user.show.all')->middleware('auth');
Route::get('users/{user_id}/edit', 'UserController@showEditUser')->name('user.edit.show')->middleware('auth');
Route::post('users/{user_id}/edit', 'UserController@editUser')->name('user.edit')->middleware('auth');
Route::post('users/{user_id}/delete', 'UserController@deleteUser')->name('user.delete')->middleware('auth');
Route::get('users/{user_id}', 'UserController@show')->name('user.show')->middleware('auth');