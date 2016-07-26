<?php
namespace App\Http\Controllers\Home;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\User;
use App\bet;
use App\pool;
use App\nextinfo;
use App\openrecord;
use App\category;
use Redirect;
use DB;
use Input;
use App\common;
use Illuminate\Support\Facades\Session;
use App\rule;
use App\application;
use App\level;

class IndexController extends Controller
{
     public function rules(){
        $rule=DB::table('rules')->orderBy('created_at','desc')->first();
     
        return view('home.rules')->with('rule',$rule);
    }

//用户提现申请
    public function withdraw_apply($id=null){
        if($id!=null){
            $user = DB::table('users')->where('id','=',$id)->get();
            if($user){
                $application = new application;
                $application->userid = $id;
                $application->save();
                return redirect('/index');
            }else{
                return redirect()->back()->with('errors','该用户不存在');
            }
            
        }else{
            return redirect()->back()->with('errors','请求错误');
        }
    }
   
    public function withdraw(){
        if(Session::get('username')){
            $username = Session::get('username');
            $user=DB::table('users')->where('username','=',$username)->get();
            $point=$user[0]->point;
            $userid = $user[0]->id;
            $data=[
                'username' => $username,
                'point' => $point,
                'userid' => $userid,
            ];
            return view('home.withdraw',$data);
        }else{
            return redirect('/');
        }
        
    }
    
   //显示登录页面
    public function login(){
        return view('home.login');
    }

    public function logout(){
        Session::forget('username');
        Session::forget('userid');
        Session::flush();
        //setcookie('password',"");
        return redirect('/');
    }

//用户登录表单的处理post类型
    public function logindeal(){

        //$password = Request::input('password');
        // if( strlen($password)>10 ){  //判断密码是否加过密
        //     $password = $password;
        // }else{
        //     $password = md5($password);
        // }
        $username  = Request::input('username');
        $remember=Request::input('remember');//是否自动登录标示
        //dd($username);die;
        if($username==''){
            return redirect()->back()->with('errors','请输入你的邀请码');
        }
        //dd($username);die;
        //$user=DB::table('users')->where('username','=',$username)->get();
        $user=DB::select('select * from users where username = ?', [$username]); 
        //dd($user); die;   
        if($user){
            //$truepsw = md5(trim($user[0]->password));
            //验证密码
            // if($truepsw == $password){
                // if (session_id()) {
                //     return redirect()->back()->with('errors','该账号已在别处登录'); 
                // }
                //存储用户账号和id
                $userid = $user[0]->id;
                $u=User::find($userid);
                $u->save();
                Session::put('userid',$userid);
                Session::put('username',$username);
                if(!empty($remember)){//如果用户选择了，记录登录状态就把用户名和加了密的密码放到cookie里面
                           setcookie("username",$username,strtotime(getCurrentTime())+3600*24*365);
                           //setcookie("password",$password,strtotime(getCurrentTime())+3600*24*365);
                           setcookie("remember",$remember,strtotime(getCurrentTime())+3600*24*365);
                }else{
                        setcookie("username","");
                        //setcookie("password","");
                        setcookie('remember',"");
                }
                //结算
                $common=new common();
                $common->account();
        
                //更新开奖记录数据库
                $common->updateOpenRecord();
                //更新下一期开奖信息数据库
                $common->updateNextOpenInfo();
                return redirect('/index')->with('message','欢迎你！');
            // }else{
            //     return redirect()->back()->with('errors','密码错误');
            // }
        }else{
            return redirect()->back()->with('errors','您输入的邀请码不正确');
        }
              
    }

    public function index(){

        if($username=Session::get('username')){

            $common=new common();
            $common->updateOpenRecord();
            //$common->updateDB();          
            //从下注记录表中读出未结算记录，进行结算
            //$common->account();
            //从数据库查询数据，传给前台显示
            //如果没有网，怎么处理
            $dates=DB::table('openrecords')->orderBy('time','desc')->take('20')->get();
            $user=DB::table('users')->where('username','=',$username)->get();
            $point=$user[0]->point;

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

            //读出下一条开奖信息
            $nexts=nextinfo::all();
            if ($dbNub!=$newNub&&count($nexts)==0) {
                $nextinfos=new nextinfo;
                date_default_timezone_set('PRC');
                $date=getCurrentDate(); //2016-07-09
                $expect=$date."001";
                $nextinfos->period=$expect;
                $nextinfos->time="00:05";
                $nextinfos->save();

            }
            $nexts=nextinfo::all();
            if (count($nexts)==0) {
               //计算出下一期开奖时间
                $lastest=DB::table('openrecords')->orderBy('time','desc')->first();
                if (count($lastest)==0) {
                    $nextinfos=new nextinfo;
                    date_default_timezone_set('PRC');
                    $date=getCurrentDate(); //2016-07-09
                    $expect=$date."001";
                    $nextinfos->period=$expect;
                    $nextinfos->time="00:05";
                    $nextinfos->save(); 
                }
                else{
                    $nexttime=nextTime($lastest->time);
                    $nextexpect=nextExpect($lastest->period); 
                    $addnext=new nextinfo;
                    $addnext->period=$nextexpect;
                    $addnext->time=$nexttime;
                    $addnext->save(); 
                }
                
            }
            else{
                $nextinfo=$nexts[0];
                $nexttime=$nextinfo->time;
                $arr1=explode(":",$nexttime);
                $first=DB::table('openrecords')->orderBy('time','desc')->first();
                if (count($first)!=0) {
                    $arr2=explode(":",$first->time);
                    if (($arr2[0]*60+$arr2[1]+10)>($arr1[0]*60+$arr1[1])) {
                        $nextinfo->period=nextExpect($first->period);
                        $nextinfo->time=nextTime($first->time);
                        $nextinfo->save();
                    }
                }
                
            }
            $records=DB::table('bets as b')
                    ->leftJoin('categories as c','b.content','=','c.id')
                    ->where('b.username','=',Session::get('username'))
                    ->select('b.*','c.cName','c.cId')
                    ->orderBy('period','desc')->get();    
            $data=[
                'datas'=>$dates,
                'username'=>$username,
                'point'=>$point,
                'records'=>$records,
            ];
            return view('home.index',$data);
        }else{
            return redirect('/');
        }
       
    }

    
    //异步处理倒计时
    public function countdown(){
        /* 倒计时到时，前台想后台异步请求
        前端异步向后台传去当前期数及开奖时间，后台计算好下一期开奖期数及开奖时间
        获取开奖信息，加工整理后存入数据库
        从下注记录表中读出未结算记录，进行结算
        从数据库查询数据，传给前台显示*/
        
         //获取下一期开奖信息
        $nextinfo=nextinfo::all();
        $nexttime=$nextinfo[0]->time;
        $nextexpect=$nextinfo[0]->period;
        //倒计时时间
        date_default_timezone_set('PRC');
        $date=getCurrentDate(); //2016-07-09
        $arr=explode(":",$nexttime);
        $desTime=$date." ".$nexttime.":00";
        $now=strtotime(getCurrentTime());
        $desStamp=strtotime($desTime);
        $detail=getCurrentTime();
        $bug=explode(" ",$detail);
        $bug2=explode(":",$bug[1]);
        if (($arr[0]*60+$arr[1]==0)&&($bug2[1]>55)) {
            $desStamp=$desStamp+24*60*60;
        }
        $leftStamp=$desStamp-$now;

        if ($leftStamp==0) {
            if ($arr[0]==0&&$arr[1]==0) {
                //结算
                echo "00";
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
                //删除前一天开奖记录
                $openRecords=openrecord::all();
                if (count($openRecords)!=0) {
                    foreach ($openRecords as $key => $value) {
                        $value->delete();
                    }
                }
                //更新下一期开奖信息
                date_default_timezone_set('PRC');
                $date=getCurrentDate(); //2016-07-09
                $arr3=explode("-",$date);
                $dstr=$arr3[0].$arr3[1].$arr3[2];
                $expect=$dstr."001";
                $nextinfos=nextinfo::all();
                $nextinfos[0]->period=$expect;
                $nextinfos[0]->time="00:05";
                $nextinfos[0]->save();

            }else{
                $nextinfos=nextinfo::all();
                $nextinfo[0]->period=nextExpect($nextinfo[0]->period);
                $nextinfo[0]->time=nextTime($nextinfo[0]->time);
                $nextinfo[0]->save();
            }
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
    }

    
    //下注处理
    public function buyFun(){
        //用户积分减少
        //存储下注记录
        if($username=Session::get('username')){
            date_default_timezone_set('PRC');
            $now=getCurrentTime();
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
                    $user->point=$user->point-$point;
                    if (($user->consuption-$point)<0) {
                        $user->consuption=0;
                    }else{
                        $user->consuption=$user->consuption-$point;
                    }
                    

                    if ($user->save()) {
                       //更改彩池数据
                       $pools=pool::all();
                       if (count($pools)==0) {
                           $pool=new pool;
                           $pool->num='-'.$point;
                           $pool->save();
                       }
                       else{
                            $pools[0]->num=$pools[0]->num-$point;
                            $pools[0]->save();
                       }
                    }
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
            $level = $user->level;
            $levelmax = DB::table('levels')->where('level','=',$level)->get();
            //dd($levelmax);die;
            $data=[
                'bigs'=>$big,
                'smalls'=>$samll,
                'singles'=>$single,
                'doubles'=>$double,
                'point'=>$user->point,
                'maxvalue'=>$levelmax[0]->max,
            ];
            return view('home.buy',$data);
        }else{
            return redirect('/');
        }
        
    }

}

