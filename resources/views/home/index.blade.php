@extends('home.nav')
@section('headder')
	.panel{
		border:2px solid #ccc;
		box-shadow:3px 3px #cccc;
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
                <table class="table">
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
						<tr>
							<td class="period"><a href="/award/ssq/2016078.html#from=kjdt">2016078期</a></td>
							<td>21:00</td>
							<td colspan="5" style="text-align:center;">距离开奖时间还有xx分钟</td>
							<td><input type='button' value="投注" ></td>
						</tr>
						<tr>
							<td class="period"><a href="/award/ssq/2016078.html#from=kjdt">2016078期</a></td>
							<td>21:00</td>
							<td><em class="smallRedball">02</em></td>
							<td><em class="smallRedball">03</em></td>
							<td><em class="smallRedball">04</em></td>
							<td><em class="smallRedball">02</em></td>
							<td><em class="smallRedball">02</em></td>
							<td>801</td>
						</tr>
						<tr>
							<td class="period"><a href="/award/ssq/2016078.html#from=kjdt">2016078期</a></td>
							<td>21:00</td>
							<td><em class="smallRedball">02</em></td>
							<td><em class="smallRedball">03</em></td>
							<td><em class="smallRedball">04</em></td>
							<td><em class="smallRedball">02</em></td>
							<td><em class="smallRedball">02</em></td>
							<td>801</td>
						</tr>
						<tr>
							<td class="period"><a href="/award/ssq/2016078.html#from=kjdt">2016078期</a></td>
							<td>21:00</td>
							<td><em class="smallRedball">02</em></td>
							<td><em class="smallRedball">03</em></td>
							<td><em class="smallRedball">04</em></td>
							<td><em class="smallRedball">02</em></td>
							<td><em class="smallRedball">02</em></td>
							<td>801</td>
						</tr>
						<tr>
							<td class="period"><a href="/award/ssq/2016078.html#from=kjdt">2016078期</a></td>
							<td>21:00</td>
							<td><em class="smallRedball">02</em></td>
							<td><em class="smallRedball">03</em></td>
							<td><em class="smallRedball">04</em></td>
							<td><em class="smallRedball">02</em></td>
							<td><em class="smallRedball">02</em></td>
							<td>801</td>
						</tr>
								
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
