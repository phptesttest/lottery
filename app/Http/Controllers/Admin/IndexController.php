<?php namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Providers\AppServiceProvider;
use Request;
use App\admin;
use App\User;
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
                
                if($flag===1){
                    $big = 'super_manager';
                    Session::put('big',$big);
                }
                
                Session::put('userid',$userid);
                Session::put('adname',$adname);
                Session::put('flag',$flag);

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
            $flag = Session::get('flag');
            return view('admin.index');
        }else{
            return redirect('/admin');
        }
        
    }

    public function account($id=null){  //结算管理，显示
        if(Session::get('adname')){
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
        $flag = Session::get('flag');
        return view('admin.account')->with('users',$users)->with('flag',$flag);
        }
        
    }

    public function logout(){
        Session::forget('username');
        Session::forget('userid');
        Session::forget('big');
        Session::forget('flag');
        Session::flush();
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


    public function adminpay(){
        return view('admin.adminpay');
    }

//给普通管理员充值
    public function adminpayFun(){
        $account=Request::input('account');
        $point=Request::input('point');
        $users=DB::table('users')->where('username','=',$account)->get();
        $id=$users[0]->id;
        $adminId=Session::get('userid');
        $user=admin::find($id);
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
        
        return view('admin.adminpay');
    }


//显示出所有的管理员
    public function adminlist(){
        $admins=DB::table('admins')->where('flag','=','2')->orderBy('created_at','desc')->get();

        return view('admin.adminlist')->with('admins',$admins);
    }

    public function admindelete($id=null){
        if($id != null){
            $admins=admin::find($id);  //提现记录删除
                if (!is_null($admins)) {
                    $admins->delete();
                }
            }
            //显示提现记录
            $admins = DB::table('admins')->get();
            return view('admin.adminlist')->with('admins',$admins);
    }

    //生成用户账号
    public function adminlistFun(){

        $point=Request::input('wPool');
        $account=getRandomAccount(10);
        $password=getRandomPassword(10);
        $admin = new admin();
        $admin->wPool=$point;
        $admin->aName=$account;
        $admin->password=$password;
        $admin->flag = 2;
        $admin->save();
        return Redirect('/admin/adminlist');
    }



}
