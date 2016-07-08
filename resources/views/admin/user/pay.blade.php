@extends('admin/nav')
@section('headder')
	.panel{
		border:2px solid #ccc;
		box-shadow:3px 3px #cccc;
	}
@endsection
@section('content')
	<div class="container">
    <div class="col-xs-12 col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">用户充值</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>请输入要充值的账号</td>
                        <td><input type='text' ></td>
                        <td><button type='submit'>充值</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection