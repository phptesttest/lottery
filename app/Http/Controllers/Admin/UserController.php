<?php namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\User;
use App\pool;
use App\admin;
use App\openrecord;
use App\recharge;
use Redirect;
use DB;
use Session;

class UserController extends Controller
{
    //生成用户账号
    public function create(){

        $level=Request::input('level');
        $point=Request::input('point');
        $account=getRandomAccount(10);
        $password=getRandomPassword(10);
        $user=new User();
        $user->level=$level;
        $user->point=$point;
        $user->username=$account;
        $user->password=$password;
        
        if ($user->save()) {
            //扣除管理员福利池
           $adminid=$adname=Session::get('adminid');
           $admin=admin::find($adminid);
           $admin->wPool=$admin->wPool-$point;
           $admin->save();

           //更改彩池数据
           $pools=pool::all();
           if (count($pools)==0) {
               $pool=new pool;
               $pool->num=$point;
               $pool->save();
           }
           else{
                $pools[0]->num=$pools[0]->num+$point;
                $pools[0]->save();
           }
        }



        return Redirect('/admin/userlist');
    }

    public function search(){
        //结算
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
    	return view('admin.user.search');
    }

    //查询逻辑处理
    public function searchFun(){

    	$account=Request::input('account');
    	$users=DB::table('users')->where('username','=',$account)->get();
        if (count($users)==0) {
            return view('admin.user.search')->with('errors','该用户不存在');
        }
    	if (count($users)!=0) {
    		$id=$users[0]->id;
    		$user=User::find($id);
    		$data=[
			'user'=>$user,
			];
    		return view('admin.user.search',$data);
    	}
    	else 
    		return view('admin.user.search');
    	
    }

    public function produce(){
    	return view('admin.user.produce');
    }

    public function pay(){
    	return view('admin.user.pay');
    }

    //用户充值逻辑处理
    public function payFun(){

    	$account=Request::input('account');
    	$point=Request::input('point');
    	$users=DB::table('users')->where('username','=',$account)->get();
        if (count($users)==0) {
            return view('admin.user.pay')->with('errors','该用户不存在');
        }
    	$id=$users[0]->id;
        $adminId=Session::get('adminid');
    	$user=User::find($id);
    	if (!is_null($user)) {
    		$oldPoint=$user->point;
    		$user->point=$oldPoint+$point;
            if ($user->save()) {
                //存储操作管理信息
                $adminid=$adname=Session::get('adminid');
                $admin=admin::find($adminid);
                $admin->wPool=$admin->wPool-$point;
                $admin->save();
                //存储充值记录
                $recharge=new recharge;
                $recharge->username=$user->username;
                $recharge->num=$point;
                $recharge->adminId=$adminId;
                $recharge->save();
                //更改彩池数据
               $pools=pool::all();
               if (count($pools)==0) {
                   $pool=new pool;
                   $pool->num=$point;
                   $pool->save();
               }
               else{
                    $pools[0]->num=$pools[0]->num+$point;
                    $pools[0]->save();
               }

            }
    		
    	}
        
    	
    	return view('admin.user.pay')->with('errors','充值成功');
    }

    public function userlist($id=null){
        //结算
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

    	//$users=user::all()->orderBy('c.created_at','desc');
        if ($id!=null) {
            $delusr=User::find($id);
            if (!is_null($delusr)) {
                $delusr->delete();
            }
            
        }
    	$users=DB::table('users')->orderBy('created_at','desc')->get();
    	$data=[
			'users'=>$users,
		];
    	return view('admin.user.list',$data);
    }
}


