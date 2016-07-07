@extends('app')

@section('content')
<h2 class="title"><strong>欢迎来到彩票页面</strong></h2>
		<table class="awardList">
			<colgroup>
				<col width="10%">
				<col width="9%">
				<col width="29%">
				<col width="7%">
				<col width="5%">
				<col width="5%">
				<col width="5%">
				<col>
				<col width="7%">
			</colgroup>
			<thead>
			<tr>
				<th>期次</th>
				<th>开奖时间</th>
				<th>开奖号码</th>
				<th>头奖奖金</th>
				<th>详情</th>
				<th>走势</th>
				<th>预测</th>
				<th>投注提示</th>
				<th class="buy">购买</th>
			</tr>
			</thead>
			<tbody>
				<tr>
		
					<td class="period"><a href="/award/ssq/2016078.html#from=kjdt">2016078期</a></td>
					<td>昨天(周四)</td>
					<td>			<em class="smallRedball">02</em>
			<em class="smallRedball">04</em>
			<em class="smallRedball">08</em>
			<em class="smallRedball">23</em>
			<em class="smallRedball">26</em>
			<em class="smallRedball">29</em>
			<em class="smallBlueball">02</em>
<a href="/award/ssq/2016078.html#anchorLink">计算奖金</a></td>
					<td>801万</td>
					<td><a href="/award/ssq/2016078.html#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/ssq/#from=kjdt">走势</a></td>
					<td><a href="http://cai.163.com/ssq/yuce/#from=kjdt">预测</a></td>
					<td>奖池：9亿5313万</td>
					<td class="buy"><a class="betBtn" href="/order/ssq/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="period"><a href="/award/dlt/16078.html#from=kjdt">16078期</a></td>
					<td>07-06(周三)</td>
					<td>			<em class="smallRedball">07</em>
			<em class="smallRedball">18</em>
			<em class="smallRedball">29</em>
			<em class="smallRedball">31</em>
			<em class="smallRedball">35</em>
			<em class="smallBlueball">05</em>
			<em class="smallBlueball">11</em>
<a href="/award/dlt/16078.html#anchorLink">计算奖金</a></td>
					<td>1000万</td>
					<td><a href="/award/dlt/16078.html#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/dlt/#from=kjdt">走势</a></td>
					<td><a href="http://cai.163.com/dlt/yuce/#from=kjdt">预测</a></td>
					<td>奖池：33亿1633万</td>
					<td class="buy"><a class="betBtn" href="/order/dlt/#from=kjdt">投注</a></td>
				</tr>
				
				
			</tbody>
	</table>

@endsection