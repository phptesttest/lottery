<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use DB;

class RecordController extends Controller
{

	//返回充值记录的数据
    public function recharge(){

    	$recharges = DB::table('recharges as r')
    	->leftJoin('admins as a','r.adminId','=','a.id')
    	->select('r.*','a.aName')
    	->orderBy('r.created_at','desc')
    	->get();

    	return view('admin.record.recharge')->with('recharges',$recharges);
    }

    //返回下注记录的数据
    public function betrecord(){

    	$bets = DB::table('bets')->get();

    	return view('admin.record.betrecord')->with('bets',$bets);
    }


    //返回开奖记录的数据
    public function openrecord(){

    	return view('admin.record.openrecord');
    }
}

