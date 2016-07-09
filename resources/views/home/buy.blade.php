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
            </div>
            <div class="panel-body">
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
							<td><input type='text'></td>
					    @endforeach
					    </tr>

					    <!-- 小球 -->
					    <tr>
					    @foreach($smalls as $small)
					    	<td>小</td>
							<td><?php echo $small->rate ?></td>
							<td><input type='text'></td>
					    @endforeach
					    </tr>

					    <!-- 单球 -->
					    <tr>
					    @foreach($singles as $single)
					    	<td>单</td>
							<td><?php echo $single->rate ?></td>
							<td><input type='text'></td>
					    @endforeach
					    </tr>

					    <!-- 双球 -->
					    <tr>
					    @foreach($doubles as $double)
					    	<td>双</td>
							<td><?php echo $double->rate ?></td>
							<td><input type='text'></td>
					    @endforeach
					    </tr>

					    @endif

                </table>
                <button type="submit" class="btn ">返回</button>
                <button type="submit" class="btn ">重置</button>
                <button type="submit" class="btn ">提交下注</button>
                
            </div>
        </div>
    </div>
</div>
@endsection
