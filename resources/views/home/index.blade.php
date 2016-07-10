@extends('home.nav')
@section('headder')
	.panel{
		border:2px solid #ccc;
		box-shadow:3px 3px #cccc;
	}
	.result tr td{
		text-align:center;
	}
	.smallRedball{
		background-color:rgb(46,94,187);
		color:white;
		display: block;
		width: 30px;
		height: 30px;
		line-height:30px;
		border-radius: 30px
	}
@endsection

@section('content')
@extends('home.person')


<div class="container">
    <div class="col-xs-12 col-sm-9">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">彩票结果信息</h3>
            </div>
            <div class="panel-body">
                <table class="table  result">
                    <tr>
							<th>期次</th>
							<th>开奖时间</th>
							<th>第一球</th>
							<th>第二球</th>
							<th>第三球</th>
							<th>第四球</th>
							<th>第五球</th>
							<th>总和</th>
						</tr>
						

						@if(count($datas)==0)

					      <p>还没有开奖信息</p>  

					    @else
					    <tr>
							<td class="period"><?php echo expectTurn(nextExpect($datas[0]->expect)) ?></td>
							<td><?php echo nextTime($datas[0]->opentime) ?></td>
							<td colspan="5" style="text-align:center;color:red;">距离开奖时间还有
							<input type="hidden" id="desTime" value="<?php echo desTime($datas[0]->opentime) ?>">
							<span id="t_m"></span>
        					<span id="t_s"></span> 
							</td>
							<td><a href="{{ asset('/buy')}}"><input type='button' class='btn btn-info' value="投注" ></a></td>
						</tr>
					    @foreach($datas as $data)
					    	<tr>
							<td class="period"><?php echo expectTurn($data->expect) ?></td>
							<td><?php echo timeTurn($data->opentime) ?></td>
					        <?php
					        	$all=0; 
					        	$arr=stringToArray($data->opencode);
					        	foreach ($arr as $key => $value) {
					        		$all=$all+$value;
					        ?>

					        		<td><em class="smallRedball"><?php echo $value;?></em></td>
					        <?php
					        	}
					        ?>
					        <td><?php echo $all ?></td>
					        </tr>
					    @endforeach

					    @endif
		
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

//日期与时间戳的转换
(function($) {
  $.extend({
    myTime: {
      /**
       * 当前时间戳
       * @return <int>    unix时间戳(秒) 
       */
      CurTime: function(){
        return Date.parse(new Date())/1000;
      },
      /**       
       * 日期 转换为 Unix时间戳
       * @param <string> 2014-01-01 20:20:20 日期格式       
       * @return <int>    unix时间戳(秒)       
       */
      DateToUnix: function(string) {
        var f = string.split(' ', 2);
        var d = (f[0] ? f[0] : '').split('-', 3);
        var t = (f[1] ? f[1] : '').split(':', 3);
        return (new Date(
            parseInt(d[0], 10) || null,
            (parseInt(d[1], 10) || 1) - 1,
            parseInt(d[2], 10) || null,
            parseInt(t[0], 10) || null,
            parseInt(t[1], 10) || null,
            parseInt(t[2], 10) || null
            )).getTime() / 1000;
      },
      /**       
       * 时间戳转换日期       
       * @param <int> unixTime  待时间戳(秒)       
       * @param <bool> isFull  返回完整时间(Y-m-d 或者 Y-m-d H:i:s)       
       * @param <int> timeZone  时区       
       */
      UnixToDate: function(unixTime, isFull, timeZone) {
        if (typeof (timeZone) == 'number')
        {
          unixTime = parseInt(unixTime) + parseInt(timeZone) * 60 * 60;
        }
        var time = new Date(unixTime * 1000);
        var ymdhis = "";
        ymdhis += time.getUTCFullYear() + "-";
        if (time.getUTCMonth()<10) {
        	ymdhis=ymdhis+"0"+(time.getUTCMonth()+1) + "-";
        }else{
        	ymdhis += (time.getUTCMonth()+1) + "-";
        }
       
        ymdhis += time.getUTCDate();
        if (isFull === true)
        {
          ymdhis += " " + time.getUTCHours() + ":";
          ymdhis += time.getUTCMinutes() + ":";
          ymdhis += time.getUTCSeconds();
        }
        return ymdhis;
      }
    }
  });
})(jQuery);
	
	var flag;
   function GetRTime(str){
       var EndTime= new Date(str);
       var NowTime = new Date();
       var t =EndTime.getTime() - NowTime.getTime();
 
       var m=Math.floor(t/1000/60%60);
       var s=Math.floor(t/1000%60);
       if (m<0) {
       	clearInterval(flag);//str加十分钟再开始
       	var stamp=$.myTime.DateToUnix(str);
       	stamp=stamp+10*60+8*60*60;
       	var newStr=$.myTime.UnixToDate(stamp,true);
       	$("#desTime").val(newStr);
       //	alert(desTime=$("#desTime").val());
       	flag=setInterval('GetRTime(newStr)',1000);
       }

       document.getElementById("t_m").innerHTML = m + " :";
       document.getElementById("t_s").innerHTML = s + "";
   }
   var desTime=$("#desTime").val();
   //alert(desTime);
   flag=setInterval('GetRTime(desTime)',1000);

   	//document.write($.myTime.DateToUnix('2016-04-12 10:49:59')+'<br>');
    // document.write($.myTime.UnixToDate(1460429399));
	//alert($.myTime.UnixToDate(1460429399,true));
</script>
@endsection
