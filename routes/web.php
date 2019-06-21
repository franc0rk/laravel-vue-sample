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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/user-profile', 'UserProfileController@edit')->name('user-profile.edit');
    Route::put('/user-profile', 'UserProfileController@update')->name('user-profile.update');

    Route::get('/user-address', 'UserAddressController@edit')->name('user-address.edit');
    Route::put('/user-address', 'UserAddressController@update')->name('user-address.update');

    Route::get('/app/{any}', 'SinglePageAppController@index')
        ->where('any', '.*')->name('app')->middleware('profile.completed');

    Route::resource('posts', 'PostController');
});
