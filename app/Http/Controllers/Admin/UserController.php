<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function search(){
    	return view('admin.user.search');
    }

    public function produce(){
    	return view('admin.user.produce');
    }

     public function pay(){
    	return view('admin.user.pay');
    }

    public function userlist(){
    	return view('admin.user.list');
    }
}

