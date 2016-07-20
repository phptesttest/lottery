<?php 
namespace App\Http\Controllers\Admin;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;
use App\withdraw;
use App\common;
use App\bet;
use App\recharge;
use App\openrecord;
use Session;

class RecordController extends Controller
{

	//返回充值记录的数据
    public function recharge($id=null){

        if ($id!=null) {
            $rec=recharge::find($id);
            if(!is_null($rec)){
                $rec->delete();
            }
        
        }

    	$recharges = DB::table('recharges as r')
    	->leftJoin('admins as a','r.adminId','=','a.id')
    	->select('r.*','a.aName')
    	->orderBy('r.created_at','desc')
    	->get();
    	return view('admin.record.recharge')->with('recharges',$recharges);
    }


    //返回下注记录的数据
    public function betrecord($id=null){
        if(Session::get('adname')){
             if ($id!=null) {
                $bet=bet::find($id);
                if(!is_null($bet)){
                    $bet->delete();
                }
             }
            $bets = DB::table('bets as b')
            ->leftJoin('categories as c','b.content','=','c.id')
            ->select('b.*','c.cName','c.cId')
            ->orderBy('b.created_at','desc')
            ->get();
            $flag = Session::get('flag');
            return view('admin.record.betrecord')->with('bets',$bets)->with('flag',$flag);
        }else{
            return redirect('/admin');
        }
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
            $withdraw = DB::table('withdraws')->orderBy('created_at','desc')->get();
            return view('admin.record.withdraw')->with('withdraw',$withdraw);
        }else{
            return redirect('/admin');
        }
    }

    //返回开奖记录的数据
    public function openrecord(){
        //获取开奖信息，加工整理后存入数据库
        // 获取数据库开奖条数
        $openRecords=openrecord::all();
        $dbNub=count($openRecords);
        $nowaday=getCurrentDate();
        //获取网站开奖条数
        $url='http://c.apiplus.net/daily.do?token=66c6e6553316f570&code=cqssc&date='.$nowaday.'&format=json';
        $file_contents = file_get_contents($url);
        $res=json_decode($file_contents); 
        $newNub=count($res->data);
        $newres=$res->data;
        // 如果条数一样，则不用更新，否则将新开奖记录存入数据库
        if ($dbNub!=$newNub) {
            //如何存储开奖记录：
            //如果数据库为空时，一次存储每一天开奖记录，开奖时间从00:05开始，如果是两点前，后一期加五分钟，如果是十点前，每后一期加十分钟.读出开奖记录时间，如果开奖时间在前面计算出来的后五分钟或十分钟内，则存入，否则，该期开奖记录为空。
            if ($dbNub==0) {
                
                for ($i=count($res->data)-1; $i>=0 ; $i--) { 
                    $openrecord=new openrecord;
                   //echo $newres[$i]->opencode;
                    $openrecord->period=$newres[$i]->expect;
                    $openrecord->number=$newres[$i]->opencode;
                    $openrecord->time=outDelay(timeTurn($newres[$i]->opentime));
                    $openrecord->save();
                }
            }
            else{
                $addNub=$newNub-$dbNub;
                for ($i=$addNub-1; $i>=0 ; $i--) { 
                    $openrecord=new openrecord;
                   //echo $newres[$i]->opencode;
                    $openrecord->period=$newres[$i]->expect;
                    $openrecord->number=$newres[$i]->opencode;
                    $openrecord->time=outDelay(timeTurn($newres[$i]->opentime));
                    $openrecord->save();
                }
            }
           
        }      

        $opens=DB::table('openrecords')->orderBy('time','desc')->paginate(15);;

    	return view('admin.record.openrecord')->with('opens',$opens);
    }

}