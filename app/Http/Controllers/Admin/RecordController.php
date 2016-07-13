<?php 
namespace App\Http\Controllers\Admin;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;
use Session;
class RecordController extends Controller
{
	
	public function recharge(){
        $recharges = DB::table('recharges as r')
        ->leftJoin('admins as a','r.adminId','=','a.id')
        ->select('r.*','a.aName')
        ->orderBy('r.created_at','desc')
        ->get();
        return view('admin.record.recharge')->with('recharges',$recharges);    
    }


    //提现记录
    public function withdraw($id=null){  
        if(Session::get('adname')){
            if($id != null){
            $withdraw=withdraw::find($id);  //提现记录删除
                if (!is_null($withdraw)) {
                    $withdraw->delete();
                }
            }
            //显示提现记录
            $withdraw = DB::table('withdraws')->get();
            return view('admin.record.withdraw')->with('withdraw',$withdraw);
        }else{
            return redirect('/admin');
        }
    }

    //返回开奖记录的数据
    public function openrecord(){

        $opens=DB::table('openrecords')->orderBy('time','desc')->get();

    	return view('admin.record.openrecord')->with('opens',$opens);
    }

    //返回下注记录的数据
    public function betrecord(){
        if(Session::get('adname')){
            $bets = DB::table('bets')->get();
            $flag = Session::get('flag');
            return view('admin.record.betrecord')->with('bets',$bets)->with('flag',$flag);
        }else{
            return redirect('/admin');
        }
    	
    }
    
}