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
	// Mail::to('quyenvu17101997@gmail.com')->send(new \App\Mail\Order(3));
	// $sp=App\Product::create([
	// 	'name'=>'Dell Vostro 3468 i5 7200U/4GB/1TB/Win10',
	// 	'price'=>13990000,
	// 	'price_sales'=>13790000,
	// 	'description'=>'Dell Vostro 3468 i5 7200U là chiếc máy tính xách tay phiên bản rút gọn được trang bị chip xử lý thế hệ mới nhất, bảo mật vân tay cùng ổ cứng HDD lên đến 1 TB.',
	// 	'category_id'=>3,
	// 	'amount'=>5,
	// 	'slug'=>'Dell-Vostro-3468-i5-7200U-4GB-1TB-Win10'
	// ]);
	// App\Value::create([
	// 	'product_id'=>$sp->id,
	// 	'attribute_id'=>3,
	// 	'value'=>'Intel Core i5 Kabylake, 7200U, 2.50 GHz',
	// ]);
	// App\Value::create([
	// 	'product_id'=>$sp->id,
	// 	'attribute_id'=>4,
	// 	'value'=>'	4 GB, DDR4 (2 khe), 2400 MHz',
	// ]);
	// App\Value::create([
	// 	'product_id'=>$sp->id,
	// 	'attribute_id'=>8,
	// 	'value'=>'	HDD: 1 TB',
	// ]);
	// App\Value::create([
	// 	'product_id'=>$sp->id,
	// 	'attribute_id'=>6,
	// 	'value'=>'	14 inch, HD (1366 x 768)',
	// ]);
	// App\Value::create([
	// 	'product_id'=>$sp->id,
	// 	'attribute_id'=>9,
	// 	'value'=>'	Card đồ họa tích hợp, Intel® HD Graphics 620',
	// ]);
	// App\Value::create([
	// 	'product_id'=>$sp->id,
	// 	'attribute_id'=>10,
	// 	'value'=>'2 x USB 3.0, HDMI, LAN (RJ45), USB 2.0, VGA (D-Sub)',
	// ]);
	// App\Value::create([
	// 	'product_id'=>$sp->id,
	// 	'attribute_id'=>1,
	// 	'value'=>'	Windows 10 Home SL',
	// ]);
	// App\Value::create([
	// 	'product_id'=>$sp->id,
	// 	'attribute_id'=>11,
	// 	'value'=>'	Vỏ nhựa, PIN rời',
	// ]);
	// App\Value::create([
	// 	'product_id'=>$sp->id,
	// 	'attribute_id'=>12,
	// 	'value'=>'Dày 23.35 mm, 1.96 kg',
	// ]);
	// App\ProductImage::create([
	// 	'product_id'=>$sp->id,
	// 	'link'=>'https://cdn.tgdd.vn/Products/Images/44/90477/dell-vostro-3468-i5-7200u-den-org-2.jpg'
	// ]);
	// App\ProductImage::create([
	// 	'product_id'=>$sp->id,
	// 	'link'=>'https://cdn.tgdd.vn/Products/Images/44/90477/dell-vostro-3468-i5-7200u-den-org-3.jpg'
	// ]);
	// App\ProductImage::create([
	// 	'product_id'=>$sp->id,
	// 	'link'=>'https://cdn.tgdd.vn/Products/Images/44/90477/dell-vostro-3468-i5-7200u-den-180x125-4.jpg'
	// ]);
	// App\ProductImage::create([
	// 	'product_id'=>$sp->id,
	// 	'link'=>'https://cdn.tgdd.vn/Products/Images/44/90477/dell-vostro-3468-i5-7200u-den-180x125-91.jpg'
	// ]);
	// App\ProductImage::create([
	// 	'product_id'=>$sp->id,
	// 	'link'=>'https://cdn.tgdd.vn/Products/Images/44/90477/dell-vostro-3468-i5-7200u-den-180x125-92.jpg'
	// ]);
	// App\ProductImage::create([
	// 	'product_id'=>$sp->id,
	// 	'link'=>'https://cdn.tgdd.vn/Products/Images/44/90477/dell-vostro-3468-i5-7200u-den-180x125-94.jpg'
	// ]);
    return view('users.listproducts');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group( function (){
	Route::get('/home','HomeController@index');
});
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
Route::get('/cart','CartController@index');
Route::get('/cart/add/{id}','CartController@add');
Route::get('/cart/update','CartController@update');
Route::get('/cart/delete','CartController@delete');
Route::get('/products/{slug}','ProductController@detail');
Route::get('/categories/{slug}','CategoryController@findCategory');
Route::get('/search','ProductController@search');