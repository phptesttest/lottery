<?php
//生成随机账号-----前台账号

if (!function_exists('getUserRandomAccount')) {
	function getUserRandomAccount($len, $chars=null)
	 {
	     if (is_null($chars)){
	         $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQUVWXYZ";
	     }  
	     mt_srand(10000000*(double)microtime());
	     for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
	         $str .= $chars[mt_rand(0, $lc)];  
	     }
	     return $str;
	 }
}

//生成随机账号---后台账号
if (!function_exists('getRandomAccount')) {
	function getRandomAccount($len, $chars=null)
	 {
	     if (is_null($chars)){
	         $chars = "abcdefghijklmnopqrs0123456789";
	     }  
	     mt_srand(10000000*(double)microtime());
	     for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
	         $str .= $chars[mt_rand(0, $lc)];  
	     }
	     return $str;
	 }
}

//生成随机密码
if (!function_exists('getRandomPassword')) {
	function getRandomPassword($len, $chars=null)
	 {
	     if (is_null($chars)){
	         $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	     }  
	     mt_srand(10000000*(double)microtime());
	     for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
	         $str .= $chars[mt_rand(0, $lc)];  
	     }
	     return $str;
	 }
}

//获取标准网络时间
if (!function_exists('getCurrentTime')) {
	function getCurrentTime(){
		$url='http://c.apiplus.net/time.json';
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$output=curl_exec($ch);
		curl_close($ch);
		$arr=json_decode($output);
		return $arr->now;
	}
	
}

//获取标准的日期
if (!function_exists('getCurrentDate')) {
	function getCurrentDate(){
		$time=getCurrentTime();
		$arr=explode(" ",$time);
		return $arr[0];
	}
}


//将开奖号码字符串转化为数组
if (!function_exists('stringToArray')) {
	function stringToArray($str){

		$arr=explode(',',$str);
		return $arr;

	}
}

//将期数字符串转化为20160703-089格式
if (!function_exists('expectTurn')) {
	function expectTurn($str){
		$str1=substr($str,0,8);
		$str2=substr($str,8);
		$str3=$str1."-".$str2;
		return $str3;
	}
}

//将开奖日期转为hh:mm格式
if (!function_exists("timeTurn")) {
	function timeTurn($str){
		$arr=explode(" ",$str);
		$str1=$arr[1];
		return substr($str1,0,5);
		//return $arr[1];
	}
}

//开奖期数加一
if (!function_exists('nextExpect')) {
	function nextExpect($str){
		return $str+1;

	}
}

//求下一期开奖时间
if (!function_exists('nextTime')) {
	//传入开奖时间
	function nextTime($str){
		$str2=explode(":",$str);
		if ($str2[0]>=10&&$str2[0]<22) {
			if($str2[1]==50){
				$str4=$str2[0]+1;
				if ($str4==24) {
					$str4='00';
				}
				$res=$str4.":"."00";
			}
			else{
				$str3=$str2[1]+10;
				$res=$str2[0].":".$str3;
			}
		}
		else{
			if($str2[1]==55){
				$str4=$str2[0]+1;
				if ($str4==24) {
					$str4='00';
				}
				$res=$str4.":"."00";
			}
			else{
				$str3=$str2[1]+5;
				if ($str3<10) {
					$str3="0".$str3;
				}
				$res=$str2[0].":".$str3;
			}
		}
		
		return $res;
	}
}

//根据开奖时间计算出对应的开奖期数
if (!function_exists('timeToExpect')) {
	//$time是开奖的小时分钟，$date是开奖年月日 
	function timeTOExpect($time,$date){
		$arr=explode(":",$time);
		$allTime=$arr[0]*60+$arr[1];
		//二十二点到凌晨两点每五分钟一期
		if ($allTime<120) {
			$expect=floor($allTime/5);
		}
		if ($allTime>1320) {
			$expect=floor(($allTime-1320)/5)+96;
		}
		//十点到二十二点每十分钟一期
		if ($allTime>=600&&$allTime<=1320){
			$expect=floor(($allTime-10*60)/10)+24;
		}
		if ($allTime==0) {
			$expect='120';
		}
		if ($expect<10) {
			$expect="00".$expect;
		}
		if ($expect>=10&&$expect<100) {
			$expect="0".$expect;
		}

		return $date."-".$expect;
	}
	# code...
}

//将开奖时间延迟去掉
if (!function_exists('outDelay')) {
	function outDelay($str){
		$arr=explode(":",$str);
		if ($arr[0]>=10&&$arr[0]<22) {
			$ss=(floor($arr[1]/10))*10;
		}
		if ($arr[0]>='0'&&$arr[0]<'2') {
			$ss=(floor($arr[1]/5))*5;
		}
		if ($arr[0]>=22&&$arr[0]<24) {
			$ss=(floor($arr[1]/5))*5;
		}
		if ($ss<10) {
			$ss="0".$ss;
		}
		return $arr[0].":".$ss;
	}
}

//下一期倒计时
if (!function_exists('desTime')) {
	//strtotime('2010-03-24 08:15:42')
	function desTime($str){
		$str1=explode(" ",$str);//xxxx-xx-xx
		$str2=explode(":",$str1[1]);
		$str3=floor($str2[1]/10)*10;
		if($str3==50){
			$str4=$str2[0]+1;
			if ($str4==24) {
				$str4='00';
			}
			$res=$str4.":"."00";
		}
		else{
			$str3=$str3+10;
			$res=$str2[0].":".$str3;
		}
		$next=$str1[0]." ".$res.":00";
		return $next;
	}
}

//判断管理员是否登录
if (!function_exists('isAdminLogin')) {
	function isAdminLogin(){
		if(!$adname=Session::get('adname')){
			return redirect('/admin');
		}
	}
}

//比较两个日期是否为同一天
if (!function_exists('isSameDay')) {
	function isSameDay($date1,$date2){
		$arr1=explode("-",$date1);
		$arr3=explode(" ",$date2);
		$arr2=explode("-",$arr3[0]);
		if (($arr1[0]==$arr2[0])&&($arr1[1]==$arr2[1])&&($arr1[2]==$arr2[2])) {
			return 1;
		}
		else{
			return 0;
		}
	}
}

//判断有没有中奖
if (!function_exists('iswin')) {
	function iswin($bet,$arrCode){
		$flag=0;
		switch ($bet->cId) {
		    case '1':{
		        switch ($bet->cName) {
		            case '大':{
		                if ($arrCode[0]>=5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '小':{
		                if ($arrCode[0]<5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '单':{
		                if (($arrCode[0]%2)==1) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '双':{
		                if (($arrCode[0]%2)==0) {
		                    $flag=1;
		                }
		                break;
		            }
		        }
		        break;
		    }

		    case '2':{
		        switch ($bet->cName) {
		            case '大':{
		                if ($arrCode[1]>=5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '小':{
		                if ($arrCode[1]<5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '单':{
		                if (($arrCode[1]%2)==1) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '双':{
		                if (($arrCode[1]%2)==0) {
		                    $flag=1;
		                }
		                break;
		            }
		        }
		        break;
		    }

		    case '3':{
		        switch ($bet->cName) {
		            case '大':{
		                if ($arrCode[2]>=5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '小':{
		                if ($arrCode[2]<5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '单':{
		                if (($arrCode[2]%2)==1) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '双':{
		                if (($arrCode[2]%2)==0) {
		                    $flag=1;
		                }
		                break;
		            }
		        }
		        break;
		    }

		    case '4':{
		        switch ($bet->cName) {
		            case '大':{
		                if ($arrCode[3]>=5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '小':{
		                if ($arrCode[3]<5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '单':{
		                if (($arrCode[3]%2)==1) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '双':{
		                if (($arrCode[3]%2)==0) {
		                    $flag=1;
		                }
		                break;
		            }
		        }
		        break;
		    }

		    case '5':{
		        switch ($bet->cName) {
		            case '大':{
		                if ($arrCode[4]>=5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '小':{
		                if ($arrCode[4]<5) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '单':{
		                if (($arrCode[4]%2)==1) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '双':{
		                if (($arrCode[4]%2)==0) {
		                    $flag=1;
		                }
		                break;
		            }
		        }
		        break;
		    }

		    case '6':{
		        $all=$arrCode[0]+$arrCode[1]+$arrCode[2]+$arrCode[3]+$arrCode[4];
		        switch ($bet->cName) {
		            case '大':{
		                if ($all>=23) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '小':{
		                if ($all<23) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '单':{
		                if (($all%2)==1) {
		                    $flag=1;
		                }
		                break;
		            }
		            case '双':{
		                if (($all%2)==0) {
		                    $flag=1;
		                }
		                break;
		            }
		        }
		        break;
		    }
		    
		}
		return $flag;
	}
}

if (!function_exists('checklogin')) {
  //检查用户是否登录
	   function checklogin(){
	           if(empty(Session('name'))){
	            //检查一下session是不是为空
	           //dd('1111');
	          if(empty($_COOKIE['username'])||empty($_COOKIE['password'])){//如果session为空，并且用户没有选择记录登录状        
	            return false;//转到登录页面，记录请求的url，登录后跳转过去，用户体验好。
	          }else{//用户选择了记住登录状态
	               $name = $_COOKIE['username'];
	               $password = $_COOKIE['password'];//去取用户的个人资料
	               $row = DB::select(' select * from users where name = ?',[$name]);
	               $pwd = md5($row[0]->password);
	              if($password == $pwd){//用户名密码不对没到取到信息，转到登录页面
	                Session('name',$name);
	                return true;
	            }else{
	                return false;
	            }
	        }
	   }else{
	           //Session('name',$name);//用户名和密码对了，把用户的个人资料放到session里面
	         
	           return true;
	       }
	}
}