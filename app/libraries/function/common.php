<?php
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