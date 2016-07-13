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

//更新开奖记录
/*if (!function_exists('update')) {
	function update(){
	  $sql = "select * from user";
	  $result = mysql_query($sql);
	  $arr = array();
	  while($rows=mysql_fetch_assoc($reslut)){
	    $arr[]=$rows;
	  }
	}
}

*/
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