@extends('home.nav')
@section('headder')
	
	.table td{
		border:2px solid #ccc;
	}
	.table tr:first-child td{
		text-align:center;
		background: #ddd;
		font-weight:bold;
	}
	input{
		width:40px;
	}
	.panel-title{
		font-size:20px;
		font-weight:bold;
		padding-bottom:10px;
	}
	.btn{
		width:auto;
	}
@endsection
@section('content')

<div class="container">
    <div class="col-xs-12 col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h1 class="panel-title">彩票结果信息</h1>
                <div class='table-responsive'>
                <table>
                	<tr>
						<td class="period"><span id="nextExpect"></span></td>
						<td>---</td>
						<td><span id="nextTime"></span></td>
						<td>---</td>
						<td colspan="5" style="text-align:center;color:red;">距离开奖时间还有
						<span id="showDes"></span>
						</td>
					</tr> 
                </table>
                </div>
            </div>
            <div class="panel-body">
            <form id="form" action="{{ asset('/buy')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input id="expect" type="hidden" name="expect" value="">


               <div class='table-responsive'>
                <table class="table">
                    <tr>
							<td colspan="3">第一球</td>
							<td colspan="3">第二球</td>
							<td colspan="3">第三球</td>
							<td colspan="3">第四球</td>
							<td colspan="3">第五球</td>
							<td colspan="3">总和</td>
							
						</tr>
						<tr>
							<td>号码</td>
							<td>赔率</td>
							<td>金额</td>

							<td>号码</td>
							<td>赔率</td>
							<td>金额</td>

							<td>号码</td>
							<td>赔率</td>
							<td>金额</td>

							<td>号码</td>
							<td>赔率</td>
							<td>金额</td>

							<td>号码</td>
							<td>赔率</td>
							<td>金额</td>

							<td>号码</td>
							<td>赔率</td>
							<td>金额</td>

							
						</tr>

						@if(count($bigs)==0)

					      <p>还没有信息</p>  

					    @else
					   	 
					   	 <!-- 大球 -->
					   	<tr>
					    @foreach($bigs as $big)
					    	<td>大</td>
							<td><?php echo $big->rate ?></td>
							<td><input class="rate" type='text' name='<?php echo $big->id.":".$big->cId."球".$big->cName ?>' ></td>
					    @endforeach
					    </tr>

					    <!-- 小球 -->
					    <tr>
					    @foreach($smalls as $small)
					    	<td>小</td>
							<td><?php echo $small->rate ?></td>
							<td><input class="rate" type='text' name='<?php echo $small->id.":".$small->cId."球".$small->cName ?>'></td>
					    @endforeach
					    </tr>

					    <!-- 单球 -->
					    <tr>
					    @foreach($singles as $single)
					    	<td>单</td>
							<td><?php echo $single->rate ?></td>
							<td><input class="rate" type='text' name='<?php echo $single->id.":".$single->cId."球".$single->cName ?>'></td>
					    @endforeach
					    </tr>

					    <!-- 双球 -->
					    <tr>
					    @foreach($doubles as $double)
					    	<td>双</td>
							<td><?php echo $double->rate ?></td>
							<td><input class="rate" type='text' name='<?php echo $double->id.":".$double->cId."球".$double->cName ?>'></td>
					    @endforeach
					    </tr>

					    @endif

                </table>
                </div>
                
                <input value=""  id="getId" type="hidden" name="getId">
                <input type="button" value="返回" class="btn btn-info" id="return">
                <input type="button" value="重置" class="btn btn-info" id="reset">
                <input type="button" value="提交" class="btn btn-info" id="sub">
               </form> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){

	$("#return").click(function(){
		history.back(-1);
	});

	$("#reset").click(function(){
		var alls=$(".rate");
		for (var i = alls.length - 1; i >= 0; i--) {
			alls[i].value="";
		}
	});
	
	$("#sub").click(function(){
		var alls=$(".rate");
		var str="";
		var res="您的下注结果是：";
		var allPoints=0;
		for (var i = alls.length - 1; i >= 0; i--) {
			if (alls[i].value!="") {
				var arr=alls[i].name.split(':');
				str=str+","+alls[i].name;
				var num=(arr[1]).substring(0,1);
				if (num==6) {
					res=res+"\n"+"总和"+(arr[1]).substring(2)+",金额为："+alls[i].value;
				}else{
					res=res+"\n"+"第"+arr[1]+",金额为："+alls[i].value;
				}
				allPoints=parseInt(allPoints)+parseInt(alls[i].value);
			}
		}
		if (({{ $point}})<allPoints) {
			alert('你的余额不足');
		}
		else if (str!="") {
			$("#getId").val(str);
			//alert(res);
			res=res+"\n"+"确定提交？";
			if(confirm(res)){
				alert("提交成功");
				$("#form").submit();
			}
		}
		else{
			alert("您还没下注");
		}		
	});
});
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
      $("#expect").val(re.nextexpect);
    }
    })
});
setTimeout("gett()",1000) 
}
gett();
</script>
@endsection
