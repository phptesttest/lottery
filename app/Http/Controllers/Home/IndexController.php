<?php

namespace App\Http\Controllers\Home;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;

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
    
    public function buy(){
    	return view('home.buy');
    }
}

