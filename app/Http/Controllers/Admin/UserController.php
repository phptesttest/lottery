<?php namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Request;

use App\user;
use App\recharge;
use Redirect;
use DB;
use Session;

class UserController extends Controller
{
    //生成用户账号
    public function create(){

        $level=Request::input('level');
        $point=Request::input('point');
        $account=getRandomAccount(10);
        $password=getRandomPassword(10);
        $user=new user();
        $user->level=$level;
        $user->point=$point;
        $user->username=$account;
        $user->password=$password;
        $user->save();

        return Redirect('/admin/userlist');
    }

    public function search(){
    	return view('admin.user.search');
    }

    //查询逻辑处理
    public function searchFun(){

    	$account=Request::input('account');
    	$users=DB::table('users')->where('username','=',$account)->get();
    	if (count($users)!=0) {
    		$id=$users[0]->id;
    		$user=user::find($id);
    		$data=[
			'user'=>$user,
			];
    		return view('admin.user.search',$data);
    	}
    	else 
    		return view('admin.user.search');
    	
    }

    public function produce(){
    	return view('admin.user.produce');
    }

    public function pay(){
    	return view('admin.user.pay');
    }

    //用户充值逻辑处理
    public function payFun(){

    	$account=Request::input('account');
    	$point=Request::input('point');
    	$users=DB::table('users')->where('username','=',$account)->get();
    	$id=$users[0]->id;
        $adminId=Session::get('adminid');
    	$user=user::find($id);
    	if (!is_null($user)) {
    		$oldPoint=$user->point;
    		$user->point=$oldPoint+$point;
    		$user->save();
    	}
        //存储充值记录
        $recharge=new recharge;
        $recharge->username=$user->username;
        $recharge->num=$point;
        $recharge->adminId=$adminId;
        $recharge->save();
    	
    	return view('admin.user.pay');
    }

    public function userlist(){

    	//$users=user::all()->orderBy('c.created_at','desc');
    	$users=DB::table('users')->orderBy('created_at','desc')->get();
    	$data=[
			'users'=>$users,
		];
    	return view('admin.user.list',$data);
    }
}


