<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
    If the request is root then return the login view.
*/
Route::get('/', function () {
    return view('login');
});

/*
    Uses a controller to handle the logic.
    Fetches a coursework page when a coursework ID is given.
*/
Route::get('/coursework/{courseworkID}', 'CourseworkController@show');