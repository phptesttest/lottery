<?php
namespace App\Http\Controllers\Home;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\user;
use App\bet;
use App\nextinfo;
use App\openRecord;
use App\category;
use Redirect;
use DB;
use Input;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{

    public function rules(){
        return view('home.rules');
    }

    public function withdraw(){
        return view('home.withdraw');
    }
    
   //显示登录页面
    public function login(){
    	return view('home.login');
    }

    public function logout(){
        Session::forget('username');
        Session::forget('userid');
        Session::flush();
        return redirect('/');
    }

//用户登录表单的处理post类型
    public function logindeal(){
        
        $password = Request::input('password');
        $username  = Request::input('username');
        $user=DB::table('users')->where('username','=',$username)->get();
        
        if($user){
            $truepsw = $user[0]->password;
            //验证密码
            if($truepsw == $password){
                //存储用户账号和id
                $userid = $user[0]->id;
                Session::put('userid',$userid);
                Session::put('username',$username);
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
                                $user->save();
                                                           
                            } 
                            $betId=$bet->bId;
                            $be=bet::find($betId);
                            $be->isaccount='1';
                            $be->save();     
                        }
                    }
                        
                }
                //更新开奖记录数据库
                date_default_timezone_set('PRC');
                $nowaday=date("Y-m-d");
                $openRecords=openRecord::all();
                if (count($openRecords)!=0) {
                    if (isSameDay($nowaday,$openRecords[0]->created_at)==0) {
                        foreach ($openRecords as $key => $value) {
                            $value->delete();
                        }
                    }
                }
                //更新下一期开奖信息数据库
                $nextinfos=nextinfo::all();
                if (count($nextinfos)!=0) {
                    if (isSameDay($nowaday,$nextinfos[0]->created_at)==0) {
                        foreach ($nextinfos as $key => $value) {
                            $value->delete();
                        }
                    }
                }
                return redirect('/index')->with('message','登录成功');
            }else{
                return redirect()->back()->with('errors','密码错误');
            }
        }else{
            return redirect()->back()->with('errors','该用户不存在');
        }
        

        
    }

    public function index(){

        if($username=Session::get('username')){
        //获取开奖信息，加工整理后存入数据库
        // 获取数据库开奖条数
        $openRecords=openRecord::all();
        $dbNub=count($openRecords);
        $nowaday=date("Y-m-d");
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
        //从下注记录表中读出未结算记录，进行结算
        //从数据库查询数据，传给前台显示
        //如果没有网，怎么处理
        $dates=DB::table('openrecords')->orderBy('time','desc')->take('20')->get();
        $user=DB::table('users')->where('username','=',$username)->get();
        $point=$user[0]->point;

        //读出下一条开奖信息
        $nexts=nextinfo::all();
        if (count($nexts)==0) {
           //计算出下一期开奖时间
            $lastest=DB::table('openrecords')->orderBy('time','desc')->first();
            $nexttime=nextTime($lastest->time);
            $nextexpect=nextExpect($lastest->period); 
            $addnext=new nextinfo;
            $addnext->period=$nextexpect;
            $addnext->time=$nexttime;
            $addnext->save();
        }
        else{
            $nextinfo=$nexts[0];
            $nexttime=$nextinfo->time;
            $arr1=explode(":",$nexttime);
            $first=DB::table('openrecords')->orderBy('time','desc')->first();
            $arr2=explode(":",$first->time);
            if (($arr2[0]*60+$arr2[1]+12)>($arr1[0]*60+$arr1[1])) {
                $nextinfo->period=nextExpect($first->period);
                $nextinfo->time=nextTime($first->time);
                $nextinfo->save();
            }
        }
  
        $data=[
            'datas'=>$dates,
            'username'=>$username,
            'point'=>$point,
        ];
        return view('home.index',$data);
        }else{
            return redirect('/');
        }
       
       

    }

    //异步处理倒计时
    /* 倒计时到时，前台想后台异步请求
        前端异步向后台传去当前期数及开奖时间，后台计算好下一期开奖期数及开奖时间
        获取开奖信息，加工整理后存入数据库
        从下注记录表中读出未结算记录，进行结算
        从数据库查询数据，传给前台显示*/
    public function countdown(){
         //获取下一期开奖信息
        $nextinfo=nextinfo::all();
        $nexttime=$nextinfo[0]->time;
        $nextexpect=$nextinfo[0]->period;
        //倒计时时间
        date_default_timezone_set('PRC');
        $date=date("Y-m-d"); //2010-08-29
        $desTime=$date." ".$nexttime.":00";
        $now=time();
        $desStamp=strtotime($desTime);
        $leftStamp=$desStamp-$now;
        if ($leftStamp==0) {
            echo "1";
            $nextinfo[0]->period=nextExpect($nextinfo[0]->period);
            $nextinfo[0]->time=nextTime($nextinfo[0]->time);
            $nextinfo[0]->save();
            echo "2";
        }

        $mm=floor($leftStamp/60);
        $ss=$leftStamp-$mm*60;
        if ($ss<10) {
            $ss="0".$ss;
        }
        if ($mm<10) {
            $mm="0".$mm;
        }
        $desTime=$mm.":".$ss;
        if ($leftStamp<0) {
            $desTime="00:00";
        }
        $str = array
       (
          'desTime'=>$desTime,
          'nextexpect'=>$nextexpect,
          'nexttime'=>$nexttime,
          'leftStamp'=>$leftStamp
       );
        $jsonencode = json_encode($str);
        echo $jsonencode;
        //echo $res;

    }
    
    //下注处理
    public function buyFun(){
        //用户积分减少
        //存储下注记录
        if($username=Session::get('username')){
            date_default_timezone_set('PRC');
            $now=date("Y-m-d H:i:s");
            $getId=Request::input('getId');
            $expect=Request::input("expect");
            $username=Session::get('username');
            $res=explode(",",$getId);
            $points=0;
            for ($i=1; $i <count($res); $i++) { 
                $idArr=explode(":",$res[$i]);
                $id=$idArr[0];
                $bet=new bet;
                $bet->username=$username;
                $bet->content=$id;
                $bet->period=$expect;
                $point=Request::input($res[$i]);
                $points=$points+$point;
                $bet->number=$point;
                if ($bet->save()) {
                    $users=DB::table('users')->where('username','=',$username)->get();
                    $userId=$users[0]->id;
                    $user=User::find($userId);
                    $user->point=$user->point-$points;
                    $user->save();
                }
                

            }
            

            return redirect('/buy');

        }else{
            return redirect('/');
        }
        
    }

    public function buy(){

        if($username=Session::get('username')){

            $big=DB::table('categories')->where('cName','=','大')->orderBy('cId','Asc')->get();
            $samll=DB::table('categories')->where('cName','=','小')->orderBy('cId','Asc')->get();
            $single=DB::table('categories')->where('cName','=','单')->orderBy('cId','Asc')->get();
            $double=DB::table('categories')->where('cName','=','双')->orderBy('cId','Asc')->get();
            $username=Session::get('username');
            $users=DB::table('users')->where('username','=',$username)->get();
            $userId=$users[0]->id;
            $user=User::find($userId);
            $data=[
                'bigs'=>$big,
                'smalls'=>$samll,
                'singles'=>$single,
                'doubles'=>$double,
                'point'=>$user->point,
            ];
            return view('home.buy',$data);
        }else{
            return redirect('/');
        }
        
    }

}

