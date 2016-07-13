<?php  namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use DB;
use App\withdraw;
use Session;
use App\recharge;

class RecordController  extends Controller
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
        if(Session::get('adname')){
            $bets = DB::table('bets')->get();
            $flag = Session::get('flag');
            return view('admin.record.betrecord')->with('bets',$bets)->with('flag',$flag);
        }else{
            return redirect('/admin');
        }
    	
    }


    //返回开奖记录的数据
    public function openrecord(){

        $opens=DB::table('openrecords')->orderBy('time','desc')->get();

    	return view('admin.record.openrecord')->with('opens',$opens);
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
            $flag = Session::get('flag');
            return view('admin.record.withdraw')->with('withdraw',$withdraw);
        }else{
            return redirect('/admin');
        }

    }




}

