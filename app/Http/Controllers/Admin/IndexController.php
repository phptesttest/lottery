<?php namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Providers\AppServiceProvider;
use Request;
use App\admin;
use App\recharge;
use App\User;
use App\openrecord;
use App\nextinfo;
use App\bet;
use App\admin_log;
use App\category;
use Redirect;
use DB;
use Session;
use App\rule;
class IndexController extends Controller
{

//显示管理员登录页面
    public function login(){
        return view('admin.login');
    }


//管理员登录验证
    public function logindeal(){
        $password = Request::input('password');
        if( strlen($password)>10 ){  //判断密码是否加过密
            $password = $password;
        }else{
            $password = md5($password);
        }

        $adname  = Request::input('adname');
        $remember=Request::input('remember');//是否自动登录标示
        if($password==''||$adname==''){
            return redirect()->back()->with('errors','账号或密码不能为空');
        }
        $user=DB::table('admins')->where('aName','=',$adname)->get();
        if($user){
            $truepsw = md5($user[0]->password);
            //验证密码
            if($truepsw == $password){
                //存储用户账号和id
                $userid = $user[0]->id;
                $flag = $user[0]->flag;
                /*if ($flag==2) {
                    date_default_timezone_set('PRC');
                    $now=date("Y-m-d H:i:s");
                    $admin_logs=new admin_log;           
                    $admin_logs->aName=$adname;
                    $admin_logs->loginTime=$now;
                    $admin_logs->save();
                }*/
                if($flag===1){
                    $big = 'super_manager';
                    Session::put('big',$big);
                }
                Session::put('adminid',$userid);
                Session::put('adname',$adname);
                Session::put('flag',$flag);

                if(!empty($remember)){//如果用户选择了，记录登录状态就把用户名和加了密的密码放到cookie里面
                   setcookie("adname",$adname,time()+3600*24*365);
                   setcookie("adpwd",$password,time()+3600*24*365);
                   setcookie("remember",$remember,time()+3600*24*365);
               }else{
                    setcookie("adname","");
                    setcookie("adpwd","");
                    setcookie('remember',"");
                }
                //结算
            $bets = DB::table('bets as b')
            ->leftJoin('categories as c','b.content','=','c.id')
            ->select('b.id as bId','b.*','c.*')
            ->orderBy('b.created_at','desc')
            ->get();
            foreach ($bets as $key => $bet) {
                if ($bet->isaccount==0) {
                    $expect=$bet->period;
                    $open=DB::table('openrecords')->where('period','=',$expect)->get();
                    if (count($open)!=0) {
                        $openCode=$open[0]->number;
                        $arrCode=explode(",",$openCode); 
                        if(iswin($bet,$arrCode)==1){
                            $addpoint=($bet->number)*($bet->rate);
                            $users=DB::table('users')->where('username','=',$bet->username)->get();
                            $userId=$users[0]->id;
                            $user=User::find($userId);
                            $oldPoint=$user->point;
                            $user->point=$oldPoint+$addpoint;
                            $user->save();

                        } 
                        $betId=$bet->bId;
                        $be=bet::find($betId);
                        $be->isaccount='1';
                        $be->save();  
                    }

                }
            }

            $openRecords=openRecord::all();
            if (count($openRecords)!=0) {
                    //更新开奖记录数据库
                date_default_timezone_set('PRC');
                $nowaday=date("Y-m-d");
                $openRecords=openRecord::all();
                if (count($openRecords)!=0) {
                    if (isSameDay($nowaday,$openRecords[1]->created_at)==0) {
                        foreach ($openRecords as $key => $value) {
                            $value->delete();
                        }
                    }
                }
                //更新下一期开奖信息数据库
                $nextinfos=nextinfo::all();
                if (count($nextinfos)!=0) {
                    if (isSameDay($nowaday,$nextinfos[0]->created_at)==0) {
                        foreach ($nextinfos as $key => $value) {
                            $value->delete();
                        }
                    }
                }
                return redirect('/admin/index')->with('message','登录成功');
            }
        }else{
            return redirect()->back()->with('errors','密码错误');
        }
        
    }else{
        return redirect()->back()->with('errors','该用户不存在');
    }

}

public function index($id=null){
    if($adname=Session::get('adname')){
        if ($id!=null) {
            $admins=admin_log::find($id);
            if(!is_null($admins)){
                $admins->delete();
            }
        }
        $user=DB::table('admins')->where('aName','=',$adname)->get();
        $flag = Session::get('flag');

        $admins=DB::table('admin_logs')->orderBy('created_at','desc')->get();
        $data=[
        'wPool'=>$user[0]->wPool,
        'admins'=>$admins,

        ];
        return view('admin.index',$data);
    }else{
        return redirect('/admin');
    }

}

    public function account($id=null){  //结算管理，显示
        //结算
        $bets = DB::table('bets as b')
        ->leftJoin('categories as c','b.content','=','c.id')
        ->select('b.id as bId','b.*','c.*')
        ->orderBy('b.created_at','desc')
        ->get();
        foreach ($bets as $key => $bet) {
            if ($bet->isaccount==0) {
                $expect=$bet->period;
                $open=DB::table('openrecords')->where('period','=',$expect)->get();
                if (count($open)!=0) {
                    $openCode=$open[0]->number;
                    $arrCode=explode(",",$openCode); 
                    if(iswin($bet,$arrCode)==1){
                        $addpoint=($bet->number)*($bet->rate);
                        $users=DB::table('users')->where('username','=',$bet->username)->get();
                        $userId=$users[0]->id;
                        $user=User::find($userId);
                        $oldPoint=$user->point;
                        $user->point=$oldPoint+$addpoint;
                        $user->save();

                    } 
                    $betId=$bet->bId;
                    $be=bet::find($betId);
                    $be->isaccount='1';
                    $be->save();     
                }
            }

        }
        if(Session::get('adname')){
            if($id != null){
            $user=User::find($id);  //结算管理中，请求提现
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
    setcookie('adpwd',"");
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
    if ($rate=="") {
        return view('admin.times')->with('errors','赔率不能为空');
    }
    $cate=DB::table('categories')->where('cName','=',$type)->where('cId','=',$ball)->get();
    if(count($cate)!=0) {
        $cId=$cate[0]->id;
        $category=category::find($cId);
        $category->rate=$rate;
        $category->save();
    }
    else{
        $cate=new category;
        $cate->rate=$rate;
        $cate->cName=$type;
        $cate->cId=$ball;
        $cate->save();
    }
    return view('admin.times')->with('errors','设置成功');
}


public function adminpay(){
    return view('admin.adminpay');
}

//给普通管理员充值
public function adminpayFun(){
    $account=Request::input('account');
    $point=Request::input('point');
    $admins=DB::table('admins')->where('aName','=',$account)->get();
    if (count($admins)==0) {
        return view('admin.adminpay')->with('errors','该管理员账号不存在');
    }
    $id=$admins[0]->id;
    $adminId=Session::get('adminid');
    $user=admin::find($id);
    if (!is_null($user)) {
        $oldPoint=$user->wPool;
        $user->wPool=$oldPoint+$point;
        if ($user->save()) {
            $adminid=$adname=Session::get('adminid');
            $admin=admin::find($adminid);
            $admin->wPool=$admin->wPool-$point;
            $admin->save();
        }
    }
        //存储充值记录
    $recharge=new recharge;
    $recharge->username=$user->aName;
    $recharge->num=$point;
    $recharge->adminId=$adminId;
    $recharge->save();

    return view('admin.adminpay')->with('errors','充值成功');;
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
        if ($admin->save()) {
            $adminid=$adname=Session::get('adminid');
            $admin=admin::find($adminid);
            $admin->wPool=$admin->wPool-$point;
            $admin->save();
        }
        return Redirect('/admin/adminlist');
    }

    public function rules(){
        $admins=DB::table('rules')->orderBy('created_at','desc')->get();
        return view('admin.rules')->with('rules',$admins);
    }

    public function setrules(){
        $content=Request::input('content');
        $rules = new rule();
        $rules->content=$content;
        $rules->save();
        return Redirect('/admin/rules');
    }

    public function deleterules($id=null){
        if($id != null){
            $rules = rule::find($id);
            if(!is_null($rules)){
                $rules->delete();
            }

            return Redirect('/admin/rules');
        }else{
            return '该规则不存在';
        }

    }

}