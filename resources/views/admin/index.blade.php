@extends('admin/nav')
@section('headder')
	.panel{
		border:2px solid #ccc;
		box-shadow:3px 3px #cccc;
	}
@endsection
<?php echo nextTime('22:00');?>
@section('content')
	<div class="container">
    <div class="col-xs-12 col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">管理员信息</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>上一次登陆信息</td>
                        <td>xxx</td>
                    </tr>
                    <tr>
                        <td>距离现在登陆已有</td>
                        <td>xx天</td>
                    </tr>
                    
                   
                </table>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="panel ">
            <div class="panel-heading">
                <h3 class="panel-title">开发者信息</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>Bluce工作室</td>
                        <td>莫荣辉、Bluce</td>
                    </tr>
                    <tr>
                        <td>xxxx</td>
                        <td>xxx</td>
                    </tr>
                   
                </table>
            </div>
        </div>
    </div>
</div>
@endsection