<?php

//生成随机账号
if (!function_exists('getRandomAccount')) {
	function getRandomAccount($len, $chars=null)
	 {
	     if (is_null($chars)){
	         $chars = "0123456789";
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
	function nextTime($str){
		$str1=$str+10*60+8*60*60;
		$str2=date('Y-m-d H:i:s',$str1);
		$str3=timeTurn($str2);
		$arr=explode(":",$str3);
		$str4=$arr[0];
		if($str4>22){
			$str1=$str1-5*60;
			$str2=date('Y-m-d H:i:s',$str1);
		}
		return $str2;
	}
	# code...
}

//下一期倒计时
if (!function_exists('desTime')) {
	function desTime($str){
		$str1=$str+10*60-time();
		if ($str1<0) {
			$str1=0;
		}
		$des=floor($str1/60);
		//$str2=$str1-time();
		//$str3=date('Y-m-d H:i:s',time());
		
		return $des; 
	}
}


//倒计时效果 javascript
// <div class="time">
//         <span id="t_d">00天</span>
//         <span id="t_h">00时</span>
//         <span id="t_m">00分</span>
//         <span id="t_s">00秒</span>
//     </div>
// <script>
//    function GetRTime(str){
//        var EndTime= new Date(str);
//        var NowTime = new Date();
//        var t =EndTime.getTime() - NowTime.getTime();
 
//        var m=Math.floor(t/1000/60%60);
//        var s=Math.floor(t/1000%60);

  
//        document.getElementById("t_m").innerHTML = m + "分";
//        document.getElementById("t_s").innerHTML = s + "秒";
//    }
//    setInterval("GetRTime('2017/07/10 14:29:00')",0);
// </script>