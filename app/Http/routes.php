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
	  Route::get('/buy', 'Home\IndexController@buy');//前台会员登录
	  Route::post('/buy', 'Home\IndexController@buyFun');//前台会员登录
	  Route::get('/', 'Home\IndexController@login');//前台会员登录
	  Route::post('/logindeal', 'Home\IndexController@logindeal');//前台会员登录
	  Route::get('/logout', 'Home\IndexController@logout');//前台会员登录
	  Route::get('/countdown', 'Home\IndexController@countdown');
	  Route::get('/rules','Home\IndexController@rules');
	  Route::get('/withdraw','Home\IndexController@withdraw');
	  Route::get('/withdraw/{id}','Home\IndexController@withdraw_apply');

});

/**后台部分**/
Route::group(['middleware' => ['web'],'prefix'=>'admin'], function () {
    //
	  Route::get('/','Admin\IndexController@login');//后台用户登录
	  Route::post('/logindeal','Admin\IndexController@logindeal');//后台用户登录
	  Route::get('index/{id}','Admin\IndexController@index');
	  Route::get('logout','Admin\IndexController@logout');//用户退出登录
	  Route::get('index','Admin\IndexController@index');
	  Route::get('times','Admin\IndexController@times');//赔率设置

	  Route::post('times','Admin\IndexController@timesFun');//赔率设置
	  Route::get('account','Admin\IndexController@account');//结算管理 , 提现
	  Route::get('account/{id}','Admin\IndexController@account');//结算管理 , 提现
	  Route::get('rules','Admin\IndexController@rules');
	  Route::post('setrules','Admin\IndexController@setrules');
	  Route::get('deleterules/{id}','Admin\IndexController@deleterules');
	  Route::get('application','Admin\IndexController@application');//提现申请记录
	  Route::get('application/{id}','Admin\IndexController@application');//提现申请记录
	  Route::get('buylevel','Admin\IndexController@levelset');
	  Route::post('levelsetFun','Admin\IndexController@levelsetFun');
});

/**记录(充值记录和下注记录) Record 路由**/
Route::group(['middleware' => ['web'],'prefix'=>'admin'], function () {
    //
	  Route::get('recharge','Admin\RecordController@recharge');//充值记录
	  Route::get('betrecord','Admin\RecordController@betrecord');//下注记录
	  Route::get('openrecord','Admin\RecordController@openrecord');//下注记录
	  Route::get('withdraw','Admin\RecordController@withdraw');//结算管理 , 提现
	  Route::get('withdraw/{id}','Admin\RecordController@withdraw');//结算管理 , 提现
	  Route::get('delRecharge/{id}','Admin\RecordController@recharge');
	  Route::get('betrecord/{id}','Admin\RecordController@betrecord');
});

/**用户 User 管理路由**/
Route::group(['middleware' => ['web'],'prefix'=>'admin'], function () {
    //
	  Route::get('search','Admin\UserController@search');
	  Route::get('pay','Admin\UserController@pay');
	  Route::get('userlist','Admin\UserController@userlist');
	  Route::get('userlist/{id}','Admin\UserController@userlist');
	  Route::post('userlist','Admin\UserController@create');
	  Route::post('pay','Admin\UserController@payFun');
	  Route::post('search','Admin\UserController@searchFun');
});


/**管理员admin 管理路由**/
Route::group(['middleware' => ['web'],'prefix'=>'admin'], function () {
    //
	  Route::get('adminlist','Admin\IndexController@adminlist');
	  Route::post('adminlist','Admin\IndexController@adminlistFun');
	  Route::get('adminpay','Admin\IndexController@adminpay');
	  Route::post('adminpayFun','Admin\IndexController@adminpayFun');
	  Route::get('admindelete/{id}','Admin\IndexController@admindelete');
	  
});