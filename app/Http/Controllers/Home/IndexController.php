<?php
namespace App\Http\Controllers\Home;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\user;
use App\category;
use Redirect;
use DB;
use Input;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
   //显示登录页面
    public function login(){
    	return view('home.login');
    }

    public function logout(){
        Session::forget('username');
        Session::forget('userid');
        return redirect('/');
    }

//用户登录表单的处理post类型
    public function logindeal(){
        
        $password = Request::input('password');
        $username  = Request::input('username');
        $user=DB::table('users')->where('username','=',$username)->get();
        
        if($user){
            $truepsw = $user[0]->password;
            //验证密码
            if($truepsw == $password){
                //存储用户账号和id
                $userid = $user[0]->id;
                Session::put('userid',$userid);
                Session::put('username',$username);
                return redirect('/index')->with('message','login success');
            }else{
                return redirect()->back()->with('errors','login Failed');
            }
        }else{
            return redirect()->back()->with('errors','login Failed');
        }
        

        
    }

    public function index(){
        if($username=Session::get('username')){

            $file_contents = file_get_contents('http://c.apiplus.net/newly.do?token=66c6e6553316f570&code=cqssc&format=json&rows=20');
            $res=json_decode($file_contents); 

            $user=DB::table('users')->where('username','=',$username)->get();
            $point=$user[0]->point;
            $data=[
                'datas'=>$res->data,
                'username'=>$username,
                'point'=>$point,
            ];
            return view('home.index',$data);
        }else{
            return redirect('/');
        }
    	
    }
    
    //下注处理
    public function buyFun(){
        if($username=Session::get('username')){
            $getId=Request::input('getId');
           // echo $getId;
            $res=explode(",",$getId);
            for ($i=1; $i <count($res); $i++) { 
           // echo $res[$i].Request::input($res[$i]);
            $idArr=explode(":",$res[$i]);
            $id=$idArr[0];
            echo Request::input("expect").$id.Request::input($res[$i]);
            }


        }else{
            return redirect('/');
        }
        
    }

    public function buy(){
        if($username=Session::get('username')){
            $file_contents = file_get_contents('http://c.apiplus.net/newly.do?token=66c6e6553316f570&code=cqssc&format=json&rows=20');
            $res=json_decode($file_contents); 

            $big=DB::table('categories')->where('cName','=','大')->orderBy('cId','Asc')->get();
            $samll=DB::table('categories')->where('cName','=','小')->orderBy('cId','Asc')->get();
            $single=DB::table('categories')->where('cName','=','单')->orderBy('cId','Asc')->get();
            $double=DB::table('categories')->where('cName','=','双')->orderBy('cId','Asc')->get();
            $data=[
                'bigs'=>$big,
                'smalls'=>$samll,
                'singles'=>$single,
                'doubles'=>$double,
                'datas'=>$res->data,
            ];
            return view('home.buy',$data);
        }else{
            return redirect('/');
        }
        
    }

}

