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
    return view('users.listproducts');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group( function (){
	Route::get('/home','HomeController@index');
});
// Route::get('login', 'AdminAuth\AdminLoginController@showLoginForm')->name('admin.login');
// Route::post('login', 'AdminAuth\AdminLoginController@login')->name('admin.auth');
// Route::post('logout', 'AdminAuth\AdminLoginController@logout')->name('admin.logout');

// Route::get('register', 'AdminAuth\AdminRegisterController@showRegistrationForm')->name('admin.register');
// Route::post('register', 'AdminAuth\AdminRegisterController@register')->name('admin.signup');
Route::prefix('admin')->group(function(){
	Route::get('login', 'AdminAuth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'AdminAuth\AdminLoginController@login')->name('admin.auth');
	Route::post('logout', 'AdminAuth\AdminLoginController@logout')->name('admin.logout');
	Route::get('register', 'AdminAuth\AdminRegisterController@showRegistrationForm')->name('admin.register');
	Route::post('register', 'AdminAuth\AdminRegisterController@register')->name('admin.signup');
	Route::middleware('admin')->group(function(){
		Route::get('/home',function(){
			return view('admin.home');
		});		
	});
});