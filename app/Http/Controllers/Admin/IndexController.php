<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function login(){
    	return view('admin.login');
    }

    public function index(){
        
    	return view('admin.index');
    }

    public function account(){
    	return view('admin.account');
    }

    public function logout(){
    	
    }
}

