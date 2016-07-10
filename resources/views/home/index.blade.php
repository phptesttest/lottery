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

<div class="col-xs-12 col-sm-3">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">彩票结果信息</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    	<tr>
							<th>用户账号</th>
							<th>用户余额</th>
						</tr>
						<tr>
							<td><em>{{$username}}</em></td>
							<td><em>{{$point}}</em></td>
						</tr>
						
                </table>
            </div>
      </div>
</div>


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
							<td><?php echo timeTurn(nextTime($datas[0]->opentimestamp)) ?></td>
							<td colspan="5" style="text-align:center;color:red;">距离开奖时间还有
							<?php 
								echo desTime($datas[0]->opentimestamp)
							?>
							分钟
							<span id="t_m">00分</span>
        					<span id="t_s">00秒</span>
							</td>
							<td><a href='/buy'><input type='button' class='btn btn-info'value="投注" ></a></td>
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
   function GetRTime(str){
       var EndTime= new Date(str);
       var NowTime = new Date();
       var t =EndTime.getTime() - NowTime.getTime();
 
       var m=Math.floor(t/1000/60%60);
       var s=Math.floor(t/1000%60);

       document.getElementById("t_m").innerHTML = m + "分";
       document.getElementById("t_s").innerHTML = s + "秒";
   }
   setInterval("GetRTime('2017-07-10 15:05:00')",0);
</script>
@endsection
