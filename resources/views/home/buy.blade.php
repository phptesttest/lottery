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
						<tr>
				
							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>	

						</tr>
						<tr>
				
							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>	

						</tr>
						<tr>
				
							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>	

						</tr>
						<tr>
				
							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>

							<td>大</td>
							<td>1.95</td>
							<td><input type='text'></td>	

						</tr>
                </table>
                <button type="submit" class="btn ">返回</button>
                <button type="submit" class="btn ">重置</button>
                <button type="submit" class="btn ">提交下注</button>
                
            </div>
        </div>
    </div>
</div>
@endsection
