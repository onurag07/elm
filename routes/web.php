<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => 'auth'], function (){


        Route::get('/home', 'DashboardController@index')->name('home');

        Route::get('/status', 'LeaveController@index')->name('leave.status');

        Route::get('/profile', 'UserController@profile')->name('user.profile');
        Route::post('/profile', 'UserController@update')->name('user.update');

        Route::get('/application', 'LeaveController@create')->name('leave.application');
        Route::post('/application', 'LeaveController@store')->name('leave.store');


        Route::get('/user', 'UserController@profileApproval')->name('userProfile.approval');

        Route::patch('/user', 'UserController@approval')->name('userProfile.approval');

        Route::get('/active-profile', 'UserController@activeprofile')->name('user.activeprofile');

        Route::get('/leave-approval', 'LeaveController@show')->name('leave.show');

        Route::patch('/leave-approval', 'LeaveController@leaveapproval')->name('leave.approval');

        Route::get('/leave-status', 'LeaveController@status')->name('leave.status');

        Route::get('/user-leave-status', 'LeaveController@userleavestatus')->name('leave.userstatus');




});
