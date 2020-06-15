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
    return 'Hello Ke~This is Edlm Api Url.Plase post!What can I do for you?';
});
Route::get('/lps', function () {
    return 'Welcome to use Pays！';
});
Route::get('/doc',function(){
	return view('doc',['index'=>'1']);
});
Route::get('/doc/s',function(){
	return view('s',['lpapi'=>'1', 'lps' => '1']);
});
Route::get('/doc/new',function(){
	return view('new',['lpapi'=>'1', 'lpn' => '1']);
});
Route::get('/doc/on',function(){
	return view('on',['lpapi'=>'1', 'lpo' => '1']);
});
Route::get('/doc/ok',function(){
	return view('ok',['lpapi'=>'1', 'lpok' => '1']);
});
Route::get('/doc/go',function(){
	return view('go',['lpapi'=>'1', 'lpg' => '1']);
});
//软件安全防护
Route::post('/lps/token/{appid}', 'LpController@token');
Route::post('/lps/entry/{token}', 'LpController@entry');
//支付宝安全防护
Route::post('/lps/apost/{appid}', 'LpController@apost');
Route::post('/lps/acpost/{appid}', 'LpController@acpost');
Route::post('/lps/adpost/{appid}', 'LpController@adpost');
Route::post('/lps/acc/{appid}', 'LpController@acc');
Route::post('/lps/acs/{appid}', 'LpController@acs');
//微信安全防护
Route::post('/lps/wpost/{appid}', 'LpController@wpost');
Route::post('/lps/wcpost/{appid}', 'LpController@wcpost');
Route::post('/lps/wdpost/{appid}', 'LpController@wdpost');
Route::post('/lps/wcc/{appid}', 'LpController@wcc');
Route::post('/lps/wcs/{appid}', 'LpController@wcs');
//QQ安全防护
Route::post('/lps/qpost/{appid}', 'LpController@qpost');
Route::post('/lps/qcpost/{appid}', 'LpController@qcpost');
Route::post('/lps/qdpost/{appid}', 'LpController@qdpost');
Route::post('/lps/qcc/{appid}', 'LpController@qcc');
Route::post('/lps/qcs/{appid}', 'LpController@qcs');
//检查更新
Route::get('/CheckVersion/{v}',function($v){
	$class = App::make('App\\Http\\Controllers\\VersionController');
	return $class->check($v);
});
//删除过期订单
Route::get('/lps/del/{type}',function($type){
	$class = App::make('App\\Http\\Controllers\\DelController');
	return $class->del($type);
});