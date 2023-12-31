<?php

use Illuminate\Support\Facades\Auth;
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


// ALL CONTROLLERS
Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.pengajuan.index');
    } else {
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.pengajuan.index');
        } else {
            if (Auth::guard('lead')->check()) {
                return redirect()->route('lead.pengajuan.index');
            } else {
                return redirect()->route('login.index');
            }
        }
    }
});

// AUTH ROUTE
Route::namespace('App\Http\Controllers')->group(function () {

    Route::namespace('login')->prefix('auth')->name('login.')->group(function () {
        Route::get('/login', 'LoginController@index')->name('index');
        Route::post('/login', 'LoginController@authenticate')->name('authenticate');
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });

    Route::namespace('forgot')->prefix('auth')->name('forgot.')->group(function () {
        Route::get('/forgot', 'ForgotControllers@index')->name('index');
        Route::post('/forgot', 'ForgotControllers@updatepass')->name('updatepass');
    });
});

Route::namespace('App\Http\Controllers')->group(function () {

    // LEAD ROUTE
    Route::middleware('auth:lead')->prefix('lead')->name('lead.')->group(function () {
        // ROUTE TO DASHBOARD CONTROLLERS
        Route::namespace('dashboard')->name('dashboard.')->group(function () {
            Route::get('/dashboard', 'DashboardControllers@index')->name('index');
        });

        // ROUTE TO USERS CONTROLLERS
        Route::namespace('users')->prefix('users')->name('users.')->group(function () {
            Route::get('edit_profile/{id}', 'UsersControllers@edit_profile')->name('edit_profile');
        Route::post('update', 'UsersControllers@update')->name('update');
        });

        // ROUTE TO PENGAJUAN CUTI
        Route::namespace('pengajuan')->prefix('pengajuan')->name('pengajuan.')->group(function () {
            Route::get('/', 'pengajuanController@index')->name('index');
            Route::get('create', 'pengajuanController@create')->name('create');
            Route::post('store', 'pengajuanController@store')->name('store');
            Route::get('detail/{id}', 'pengajuanController@detail')->name('detail');
            Route::get('edit/{id}', 'pengajuanController@edit')->name('edit');
            Route::get('approve/{id}', 'pengajuanController@approve')->name('approve');
            Route::post('approval', 'pengajuanController@approval')->name('approval');
            Route::get('disapprove/{id}', 'pengajuanController@disapprove')->name('disapprove');
            Route::post('update', 'pengajuanController@update')->name('update');
            Route::post('delete', 'pengajuanController@delete')->name('delete');
            Route::post('getMonth', 'pengajuanController@getMonth')->name('getMonth');
            Route::post('export', 'pengajuanController@export')->name('export');
        });
    });

    //ADMIN ROUTE
    Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
        // ROUTE TO DASHBOARD CONTROLLERS
        Route::namespace('dashboard')->name('dashboard.')->group(function () {
            Route::get('/dashboard', 'DashboardControllers@index')->name('index');
        });

        // ROUTE TO PENGAJUAN CUTI
        Route::namespace('pengajuan')->prefix('pengajuan')->name('pengajuan.')->group(function () {
            Route::get('/', 'pengajuanController@index')->name('index');
            Route::get('create', 'pengajuanController@create')->name('create');
            Route::post('store', 'pengajuanController@store')->name('store');
            Route::get('detail/{id}', 'pengajuanController@detail')->name('detail');
            Route::get('edit/{id}', 'pengajuanController@edit')->name('edit');
            Route::get('approve/{id}', 'pengajuanController@approve')->name('approve');
            Route::post('approval', 'pengajuanController@approval')->name('approval');
            Route::get('disapprove/{id}', 'pengajuanController@disapprove')->name('disapprove');
            Route::post('update', 'pengajuanController@update')->name('update');
            Route::post('delete', 'pengajuanController@delete')->name('delete');
            Route::post('getMonth', 'pengajuanController@getMonth')->name('getMonth');
            Route::post('export', 'pengajuanController@export')->name('export');
        });

        // ROUTE TO USERS CONTROLLERS
        Route::namespace('users')->prefix('users')->name('users.')->group(function () {
            Route::get('/', 'UsersControllers@index')->name('index');
            Route::get('create', 'UsersControllers@create')->name('create');
            Route::post('store', 'UsersControllers@store')->name('store');
            Route::get('detail/{id}', 'UsersControllers@detail')->name('detail');
            Route::get('edit/{id}', 'UsersControllers@edit')->name('edit');
            Route::post('update', 'UsersControllers@update')->name('update');
            Route::post('delete', 'UsersControllers@delete')->name('delete');
        });
    });

    // USER ROUTE
    Route::middleware('auth:user')->prefix('user')->name('user.')->group(function () {

        // ROUTE TO USERS CONTROLLERS
        Route::namespace('users')->prefix('users')->name('users.')->group(function () {
            Route::get('edit_profile/{id}', 'UsersControllers@edit_profile')->name('edit_profile');
            Route::post('update', 'UsersControllers@update')->name('update');
        });

        // ROUTE TO PENGAJUAN CUTI
        Route::namespace('pengajuan')->prefix('pengajuan')->name('pengajuan.')->group(function () {
            Route::get('/', 'pengajuanController@index')->name('index');
            Route::get('create', 'pengajuanController@create')->name('create');
            Route::post('store', 'pengajuanController@store')->name('store');
            Route::get('detail/{id}', 'pengajuanController@detail')->name('detail');
            Route::get('edit/{id}', 'pengajuanController@edit')->name('edit');
            Route::post('update', 'pengajuanController@update')->name('update');
            Route::get('approve/{id}', 'pengajuanController@approve')->name('approve');
            Route::get('disapprove/{id}', 'pengajuanController@disapprove')->name('disapprove');
            Route::post('delete', 'pengajuanController@delete')->name('delete');
            Route::post('getMonth', 'pengajuanController@getMonth')->name('getMonth');
            Route::post('export', 'pengajuanController@export')->name('export');
        });
    });

    Route::namespace('pengajuan')->group(function () {
        Route::get('user/pengajuan/downloadpdf/{id}/{file}', 'pengajuanController@downloadPDF')->name('user.pengajuan.downloadPDF');
    });
    
});
