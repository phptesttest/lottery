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
                <h3 class="panel-title">管理员信息</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>亲爱的管理员{{Session::get('adname')}}</td>
                        <td>欢迎你！！</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>xx天</td>
                    </tr>
                    
                   
                </table>
            </div>
        </div>
    </div>
   <div class="col-xs-12 col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">管理员福利池</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>您的福利池为：</td>
                        <td>{{ $wPool}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    
                   
                </table>
            </div>
        </div>
    </div>
    @if(Session::has('big'))
    <div class="col-xs-12 col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">普通管理员登录信息</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>管理员名称</td>
                        <td>登录时间</td>
                        <td>操作</td>
                    </tr>
                    @foreach($admins as $admin)
                    <tr>
                        <td><?php echo $admin->aName ?></td>
                        <td><?php echo $admin->created_at ?></td>
                        <td><a href='/admin/index/{{ $admin->id}}'><button class="btn btn-danger">删除</button></a></td>
                    </tr>
                    @endforeach
                   
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
               