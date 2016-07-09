<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use DB;
use App\user;
class IndexController extends Controller
{
    public function login(){
    	return view('admin.login');
    }

    public function index(){
    	return view('admin.index');
    }

    public function account($id=null){  //结算管理，显示

        if($id != null){
            $user=user::find($id);  //结算管理中，请求提现
            if (!is_null($user)) { 
                $withdraw=new \App\withdraw;
                $withdraw->username=$user->username;
                $withdraw->withdraw_num=$user->point;
                $withdraw->save();
                $user->point=0;
                $user->save();
            }
        }

        $users = DB::table('users')->get();
    	return view('admin.account')->with('users',$users);
    }


    public function logout(){
    	
    }

    public function times(){
        return view('admin.times');
    }
}

