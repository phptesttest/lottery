<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\bet;
use App\openrecord;
use App\User;
use App\pool;
use DB;

class common extends Model
{
   
   	//判断是否中奖及处理中奖
   	public function account(){
	    $bets = DB::table('bets as b')
	    ->leftJoin('categories as c','b.content','=','c.id')
	    ->select('b.id as bId','b.*','c.*')
	    ->orderBy('b.created_at','desc')
	    ->get();
	    foreach ($bets as $key => $bet) {
	        if ($bet->isaccount==0) {
	            $expect=$bet->period;
	            $open=DB::table('openrecords')->where('period','=',$expect)->get();
	            if (count($open)!=0) {
	                $openCode=$open[0]->number;
	                $arrCode=explode(",",$openCode); 
	                if(iswin($bet,$arrCode)==1){
	                    $addpoint=($bet->number)*($bet->rate);
	                    $users=DB::table('users')->where('username','=',$bet->username)->get();
	                    $userId=$users[0]->id;
	                    $user=User::find($userId);
	                    $oldPoint=$user->point;
	                    $user->point=$oldPoint+$addpoint;
	                  //结算的时候用户的提现记录加1
	                    //$user->witime += 1;

	                    if ($user->save()) {
	                        //更改彩池数据
	                       $pools=pool::all();
	                       if (count($pools)==0) {
	                           $pool=new pool;
	                           $pool->num=$addpoint;
	                           $pool->save();
	                       }
	                       else{
	                            $pools[0]->num=$pools[0]->num+$addpoint;
	                            $pools[0]->save();
	                       }
	                    }
	                                               
	                } 
	                $betId=$bet->bId;
	                $be=bet::find($betId);
	                $be->isaccount='1';
	                $be->save();     
	            }
	        }           
    	}
   	}

	//更新开奖记录数据库
   	public function updateOpenRecord(){
	   	date_default_timezone_set('PRC');
	    $nowaday=getCurrentDate();
	    $openRecords=DB::table('openrecords')->take(2)->get();
	    if (count($openRecords)!=0) {
	        if (isSameDay($nowaday,$openRecords[0]->created_at)==0) {
	        	$openrecords=openrecord::all();
	            foreach ($openRecords as $key => $value) {
	            	$open=openRecord::find($value->id);
	                $open->delete();
	            }
	        }
	    }
	}

	//更新下一期开奖信息数据库
	public function updateNextOpenInfo(){
		date_default_timezone_set('PRC');
	    $nowaday=getCurrentDate();
		$nextinfos=nextinfo::all();
        if (count($nextinfos)!=0) {
            if (isSameDay($nowaday,$nextinfos[0]->created_at)==0) {
                foreach ($nextinfos as $key => $value) {
                    $value->delete();
                }
            }
        }
	}

	//更新数据库信息
	public function updateDB(){
		//获取开奖信息，加工整理后存入数据库
        // 获取数据库开奖条数
        $openRecords=openrecord::all();
        $dbNub=count($openRecords);
        $nowaday=getCurrentDate();
        //获取网站开奖条数
        $url='http://c.apiplus.net/daily.do?token=66c6e6553316f570&code=cqssc&date='.$nowaday.'&format=json';
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output=curl_exec($ch);
        curl_close($ch);
        //$file_contents = file_get_contents($url);
        $res=json_decode($output); 
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
	}


}
