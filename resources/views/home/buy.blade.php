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
@endsection
@section('content')

<div class="container">
    <div class="col-xs-12 col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">彩票结果信息</h3>
                <table>
                	<tr>
						<td class="period"><?php echo expectTurn(nextExpect($datas[0]->expect)) ?></td>
						
						<td colspan="5" style="text-align:center;color:red;">距离开奖时间还有
						<?php 
							echo desTime($datas[0]->opentime)
						?>
						分钟</td>
						</tr>
                </table>
            </div>
            <div class="panel-body">
            <form id="form" action="{{ asset('/buy')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
							<td><input class="rate" type='text' value="0" name='<?php echo $big->id.":".$big->cId."球".$big->cName ?>' ></td>
					    @endforeach
					    </tr>

					    <!-- 小球 -->
					    <tr>
					    @foreach($smalls as $small)
					    	<td>小</td>
							<td><?php echo $small->rate ?></td>
							<td><input class="rate" type='text' value="0" name='<?php echo $small->id.":".$small->cId."球".$small->cName ?>'></td>
					    @endforeach
					    </tr>

					    <!-- 单球 -->
					    <tr>
					    @foreach($singles as $single)
					    	<td>单</td>
							<td><?php echo $single->rate ?></td>
							<td><input class="rate" type='text' value="0" name='<?php echo $single->id.":".$single->cId."球".$single->cName ?>'></td>
					    @endforeach
					    </tr>

					    <!-- 双球 -->
					    <tr>
					    @foreach($doubles as $double)
					    	<td>双</td>
							<td><?php echo $double->rate ?></td>
							<td><input class="rate" type='text' value="0" name='<?php echo $double->id.":".$double->cId."球".$double->cName ?>'></td>
					    @endforeach
					    </tr>

					    @endif

                </table>
                <input value=""  id="getId" type="hidden" name="getId">
                <input type="hidden" name="expect" value='<?php echo expectTurn(nextExpect($datas[0]->expect)) ?>'>
                <input type="button" value="返回" class="btn" id="return">
                <input type="button" value="重置" class="btn" id="reset">
                <input type="button" value="提交" class="btn" id="sub">
               </form> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
	
	$("#sub").click(function(){
		var alls=$(".rate");
		var str="";
		var res="您的下注结果是：";
		for (var i = alls.length - 1; i >= 0; i--) {
			if (alls[i].value!=0) {
				var arr=alls[i].name.split(':');
				str=str+","+alls[i].name;
				res=res+"\n"+"第"+arr[0]+",金额为："+alls[i].value;
			}
		}
		if (str!="") {
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
</script>
@endsection
