<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Mikrotik\HomeController@index')->name('home');
Route::group(['namespace' => 'Mikrotik'], function () {
    Route::post('/auth', 'AuthController@login')->name('login.page');
    Route::get('/logout', 'AuthController@logout')->name('logout');

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/dashboard/sys', 'RealtimeController@getData');
    Route::get('/dashboard/cpu', 'RealtimeController@cpu');

    Route::get('/graf/{interfaceName}', 'InterfaceController@graf')->name('graf');

    Route::get('pppoe/server', 'PPPoEController@server')->name('pppoe.server');
    Route::get('pppoe/add/server', 'PPPoEController@showServer');
    Route::get('update/server/{id}', 'PPPoEController@serverUpdate')->name('show.server');
    Route::post('update/server/', 'PPPoEController@updateServer')->name('server.update');
    Route::post('pppoe/add/server', 'PPPoEController@addServer')->name('add.server');
    Route::get('pppoe/dellserver/{id}', 'PPPoEController@dellServer')->name('dellserver');
    Route::post('/toggle/server', 'PPPoEController@toggleServer')->name('server.toggle');

    Route::get('pppoe/profile', 'PPPoEController@profile')->name('pppoe.profile');
    Route::get('pppoe/add/profile', 'PPPoEController@showProfile');
    Route::post('pppoe/add/profile', 'PPPoEController@addProfile')->name('add.profile');
    Route::get('update/profile/{id}', 'PPPoEController@profileUpdate')->name('show.profile');
    Route::post('update/profile', 'PPPoEController@updateProfile')->name('update.profile');
    Route::get('pppoe/dellprofile/{id}', 'PPPoEController@dellProfile')->name('dell.profile');
    Route::get('pppoe/profile/{id}', 'PPPoEController@profileDetails')->name('profile.detail');

    Route::get('pppoe/secret', 'PPPoEController@secret')->name('secret.pppoe');
    Route::get('pppoe/add/secret', 'PPPoEController@showsecret');
    Route::post('pppoe/secret', 'PPPoEController@addsecret')->name('add.secret');
    Route::get('pppoe/secret/edit/{id}', 'PPPoEController@updateSecret')->name('secret.update');
    Route::post('pppoe/secret/update', 'PPPoEController@secretUpdate')->name('update.secret');
    Route::get('pppoe/dell/{id}', 'PPPoEController@dellsecret')->name('dellsecret');

    Route::get('pppoe/active', 'PPPoEController@active')->name('active.pppoe');
    Route::get('pppoe/dellactive/{id}', 'PPPoEController@dellactive')->name('dellactive');

    Route::get('ppp/isolir', 'PPPoEController@isolir')->name('isolir');







    
});

