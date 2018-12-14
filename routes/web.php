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

use Illuminate\Support\Facades\Mail;
Route::get('/', function () {
    return view('users.listproducts');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group( function (){
	Route::get('/home','HomeController@index');
});
Route::prefix('admin')->group(function(){
	Route::get('/login', 'AdminAuth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'AdminAuth\AdminLoginController@login')->name('admin.auth');
	Route::post('/logout', 'AdminAuth\AdminLoginController@logout')->name('admin.logout');
	Route::get('/register', 'AdminAuth\AdminRegisterController@showRegistrationForm')->name('admin.register');
	Route::post('/register', 'AdminAuth\AdminRegisterController@register')->name('admin.signup');
	Route::middleware('admin')->group(function(){
		Route::get('/home','HomeController@adminindex');
		Route::get('report','HomeController@adminindex');
		Route::get('listproduct','ProductController@getdata')->name('product');
		Route::post('/products/update/{id}','ProductController@update');
		Route::get('listorder','OrderController@getdata')->name('order');
		Route::get('orders/edit/{id}','OrderController@edit')->name('order');
		Route::resource('/products','ProductController');
		Route::post('/orders/update/{id}','OrderController@update');
		Route::get('/orders/delete/{id}','OrderController@destroy');
		Route::resource('/orders','OrderController');
		Route::get('/listuser','UserController@getdata')->name('user');
		Route::post('/users/update/{id}','UserController@update');
		Route::resource('/users','UserController');

	});
});
Route::get('/listorders','OrderController@listorder');
Route::get('/cart','CartController@index');
Route::get('/cart/add/{id}','CartController@add');
Route::get('/cart/update','CartController@update');
Route::get('/cart/delete','CartController@delete');
Route::get('/products/{slug}','ProductController@detail');
Route::get('/categories/{slug}','CategoryController@findCategory');
Route::get('/search','ProductController@search');
Route::get('/checkout','CartController@checkout');
Route::post('/orders/create','OrderController@store');
Route::get('/orders/delete/{id}','OrderController@destroy');
Route::resource('/orders','OrderController');