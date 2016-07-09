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

Route::group(['middleware' => ['web']], function () {
    //前台部分
	  Route::get('/', 'Home\IndexController@login');//前台会员登录
	  Route::get('/index', 'Home\IndexController@index');//前台会员登录
	  Route::get('/buy', 'Home\IndexController@buy');//前台会员登录


//后台部分
	  Route::get('/admin','Admin\IndexController@login');//后台用户登录
	  Route::get('/admin/logout','Admin\IndexController@logout');//用户退出登录
	  Route::get('/admin/index','Admin\IndexController@index');

	  Route::get('/admin/account','Admin\IndexController@account');//结算管理
	  
});


/**记录(充值记录和下注记录) Record 路由**/
Route::group(['middleware' => ['web']], function () {
    //
	  Route::get('/admin/recharge','Admin\RecordController@recharge');//充值记录
	  Route::get('/admin/betrecord','Admin\RecordController@betrecord');//下注记录
	  Route::get('/admin/openrecord','Admin\RecordController@openrecord');//下注记录

});

/**用户 User 管理路由**/
Route::group(['middleware' => ['web']], function () {
    //
	  Route::get('/admin/search','Admin\UserController@search');
	  Route::get('/admin/pay','Admin\UserController@pay');
	  Route::get('/admin/userlist','Admin\UserController@userlist');
});
