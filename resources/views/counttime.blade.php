<script>
   function GetRTime(str){
       var EndTime= new Date(str);
       var NowTime = new Date();
       var t =EndTime.getTime() - NowTime.getTime();
 
       var m=Math.floor(t/1000/60%60);
       var s=Math.floor(t/1000%60);

       document.getElementById("t_m").innerHTML = m + "分";
       document.getElementById("t_s").innerHTML = s + "秒";
   }
   setInterval("GetRTime('2017/07/10 14:29:00')",0);
</script>