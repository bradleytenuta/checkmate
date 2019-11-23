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
Route::get('modules/{id}', 'ModuleController@show')->name('modules.show')->middleware('auth');