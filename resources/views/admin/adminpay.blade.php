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
                <h3 class="panel-title">普通管理员充值</h3>
            </div>
            <div class="panel-body">
            <form action="{{ asset('/admin/pay')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class='table-responsive'>
                <table class="table">
                    <tr>
                        <td>请输入要充值的管理员账号</td>
                        <td><input type='text' name="account"></td>
                    </tr>
                    <tr>
                        <td>请输入充值的积分</td>
                        <td><input type='text' name="point"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="确定充值"></td>
                    </tr>
                </table>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection