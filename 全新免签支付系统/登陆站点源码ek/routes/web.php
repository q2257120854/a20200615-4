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
//用户
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
//重置密码
Route::any('/reset',function(){
	$class = App::make('App\\Http\\Controllers\\ResetController');
	return $class->reset('1');
});
Route::any('/reset/{s}',function($s){
	$class = App::make('App\\Http\\Controllers\\ResetController');
	return $class->reset($s);
});
//API面板
Route::any('/api',function(){
	$class = App::make('App\\Http\\Controllers\\ApiController');
	return $class->api();
})->middleware('auth');
//L Pays 订单查询
Route::any('/lps',function(){
	$class = App::make('App\\Http\\Controllers\\ApiController');
	return $class->lps();
})->middleware('auth');
//L Pays 重新通知
Route::any('/gu',function(){
	$class = App::make('App\\Http\\Controllers\\ApiController');
	return $class->gu();
})->middleware('auth');
//开通服务
Route::any('/opens',function(){
	$class = App::make('App\\Http\\Controllers\\OpensController');
	return $class->open();
});
//批量发送公告
Route::any('/mail',function(){
	$class = App::make('App\\Http\\Controllers\\ResetController');
	return $class->mail();
});

//后台面包
Route::any('/lpads',function(){
	$class = App::make('App\\Http\\Controllers\\AdminController');
	return $class->lpads();
})->middleware('auth');
