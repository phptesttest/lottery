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
    	return view('home.index');
    }
    
    public function buy(){
    	return view('home.buy');
    }
}

