<?php
namespace App\Http\Controllers\Home;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\user;
use App\category;
use Redirect;
use DB;


class IndexController extends Controller
{
    public function login(){
    	return view('home.login');
    }

    public function index(){

    	$file_contents = file_get_contents('http://c.apiplus.net/newly.do?token=66c6e6553316f570&code=cqssc&format=json&rows=20');
        $res=json_decode($file_contents); 
        $data=[
            'datas'=>$res->data,
        ];
    	return view('home.index',$data);
    }
    
    //下注处理
    public function buyFun(){

        $getId=Request::input('getId');
       // echo $getId;
        $res=explode(",",$getId);
        for ($i=1; $i <count($res); $i++) { 
           // echo $res[$i].Request::input($res[$i]);
            $idArr=explode(":",$res[$i]);
            $id=$idArr[0];
            echo Request::input("expect").$id.Request::input($res[$i]);
        }
    }

    public function buy(){

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
    }
}

