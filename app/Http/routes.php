<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//前台部分
Route::group(['middleware' => ['web']], function () {
    
	  Route::get('/index', 'Home\IndexController@index');//前台会员登录
	  Route::get('y', 'Home\IndexController@buy');//前台会员登录
	  Route::get('/', 'Home\IndexController@login');//前台会员登录
});

/**后台部分**/
Route::group(['middleware' => ['web'],'prefix'=>'admin'], function () {
    //
	  Route::get('/','Admin\IndexController@login');//后台用户登录
	  Route::get('logout','Admin\IndexController@logout');//用户退出登录
	  Route::get('index','Admin\IndexController@index');
	  Route::get('times','Admin\IndexController@times');//赔率设置

	  Route::post('times','Admin\IndexController@timesFun');//赔率设置
	  Route::get('account','Admin\IndexController@account');//结算管理
	  Route::get('account','Admin\IndexController@account');//结算管理 , 提现
	  Route::get('account/{id}','Admin\IndexController@account');//结算管理 , 提现


});

/**记录(充值记录和下注记录) Record 路由**/
Route::group(['middleware' => ['web'],'prefix'=>'admin'], function () {
    //
	  Route::get('recharge','Admin\RecordController@recharge');//充值记录
	  Route::get('betrecord','Admin\RecordController@betrecord');//下注记录
	  Route::get('openrecord','Admin\RecordController@openrecord');//下注记录
	  Route::get('withdraw','Admin\RecordController@withdraw');//结算管理 , 提现
	  Route::get('withdraw/{id}','Admin\RecordController@withdraw');//结算管理 , 提现
});

/**用户 User 管理路由**/
Route::group(['middleware' => ['web'],'prefix'=>'admin'], function () {
    //
	  Route::get('search','Admin\UserController@search');
	  Route::get('pay','Admin\UserController@pay');
	  Route::get('userlist','Admin\UserController@userlist');
	  Route::post('userlist','Admin\UserController@create');
	  Route::post('pay','Admin\UserController@payFun');
	  Route::post('search','Admin\UserController@searchFun');
});
