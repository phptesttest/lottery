<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    public function recharge(){
    	return view('admin.record.recharge');
    }

    public function betrecord(){
    	return view('admin.record.betrecord');
    }

    public function openrecord(){
    	return view('admin.record.openrecord');
    }
}

