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
		border-radius: 30px;
		text-align:center;
	}
	.container{
		padding-right:0px;
		padding-left:5px;
	}
	.table-condensed > thead > tr > th, 
	.table-condensed > tbody > tr > th, 
	.table-condensed > tfoot > tr > th, 
	.table-condensed > thead > tr > td, 
	.table-condensed > tbody > tr > td, 
	.table-condensed > tfoot > tr > td{
		padding-top: 5px;
		text-align: left;
	}
@endsection
@section('content')
<div class="col-xs-12 col-sm-3 container">
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

    <div class="col-xs-12 col-sm-9 container">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">彩票结果信息</h3>
            </div>
            <div class="panel-body">
            <div class='table-responsive'>
                <table class="table table-condensed result">
                    <tr>
							
							<th>一</th>
							<th>二</th>
							<th>三</th>
							<th>四</th>
							<th>五</th>
							<th>总和</th>
							<th>期次</th>
							<th>开奖时间</th>
						</tr>
						<tr>
							
							<td colspan="3" style="text-align:center;color:red;">距离开奖时间还有
							<span id="showDes"></span>
							<?php 
								date_default_timezone_set('PRC');
                   				$now=date("Y-m-d H:i:s");
								$arr=explode(" ",$now);
								$arrh=explode(":",$arr[1]);
								$h=$arrh[0];
								if ($h>1&&$h<10) {

							 ?>
							 <td><input type='button' class='btn btn-info' value="封盘" ></td>
							 <?php }else{  ?>
							<td colspan="2"><a href="{{ asset('/buy')}}"><input type='button' class='btn btn-info' value="投注" ></a></td>
							<?php } ?>
							<td class="period"><span id="nextExpect"></span></td>
							<td><span id="nextTime"></span></td>
						</tr> 

						@if(count($datas)==0)

					      <p>还没有开奖信息</p>  

					    @else
					    
					    @foreach($datas as $data)
					    	<tr>
							
					        <?php
					        	$all=0; 
					        	$arr=stringToArray($data->number);
					        	foreach ($arr as $key => $value) {
					        		$all=$all+$value;
					        ?>

					        		<td><em class="smallRedball"><?php echo $value;?></em></td>
					        <?php
					        	}
					        ?>
					        <td><?php echo $all ?></td>

					        <td class="period"><?php echo $data->period ?></td>
							<td><?php echo $data->time ?></td>
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
<script type="text/javascript">
function gett(){
$(function(){
  $.ajax({
    url:"{{ url('/countdown')}}",
    type:"GET",
    //data:{action:"guesslike"},
    dataType:"json",
    //timeout:3000,
    cache:false,
    success:function(re){
      $("#nextExpect").html(re.nextexpect);
      $("#nextTime").html(re.nexttime);
      $("#showDes").html(re.desTime);
      //$("#showDes").html(re.desTime);
    }
    })
});
setTimeout("gett()",1000) 
}
gett();
</script>
@endsection
