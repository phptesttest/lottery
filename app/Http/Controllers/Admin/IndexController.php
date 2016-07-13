<?php namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Request;

use App\user;
use App\category;
use Redirect;
use DB;
use Session;

class IndexController extends Controller
{

//显示管理员登录页面
    public function login(){
        return view('admin.login');
    }


//管理员登录验证
    public function logindeal(){
        $password = Request::input('password');
        $adname  = Request::input('adname');
        $user=DB::table('admins')->where('aName','=',$adname)->get();
        
        if($user){
            $truepsw = $user[0]->password;
            //验证密码
            if($truepsw == $password){
                //存储用户账号和id
                $userid = $user[0]->id;
                $flag = $user[0]->flag;
                Session::put('adminid',$userid);
                Session::put('adname',$adname);
                return redirect('/admin/index')->with('message','login success');
            }else{
                return redirect()->back()->with('errors','login Failed');
            }
        }else{
            return redirect()->back()->with('errors','login Failed');
        }
        
    }

    public function index(){
        if($adname=Session::get('adname')){
            $user=DB::table('admins')->where('aName','=',$adname)->get();
            return view('admin.index');

        }else{
            return redirect('/admin');
        }
        
    }

    public function account($id=null){  //结算管理，显示

        if($id != null){
            $user=user::find($id);  //结算管理中，请求提现
            if (!is_null($user)) { 
                $withdraw=new \App\withdraw;
                $withdraw->username=$user->username;
                $withdraw->withdraw_num=$user->point;
                $withdraw->adminname=Session::get('adname');
                $withdraw->save();
                $user->point=0;
                $user->save();
            }
        }

        $users = DB::table('users')->get();
        return view('admin.account')->with('users',$users);
    }

    public function logout(){
        Session::forget('username');
        Session::forget('userid');
        return redirect('/admin');
    }

    public function times(){
        return view('admin.times');
    }

    //赔率设置
    public function timesFun(){

        $ball=Request::input('ball');
        $type=Request::input('type');
        $rate=Request::input('rate');
        $cate=DB::table('categories')->where('cName','=',$type)->where('cId','=',$ball)->get();
        if(!is_null($cate)) {
            $cId=$cate[0]->id;
            $category=category::find($cId);
            $category->rate=$rate;
            $category->save();
        }
        return view('admin.times');
    }
}
