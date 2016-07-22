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
                <h3 class="panel-title">申请提现记录表</h3>
            </div>
            <div class="panel-body">
            <div class='table-responsive'>
                <table class="table">
                    <tr>
                        <th>时间</th>
                        <th>申请提现用户</th>
                        <th>该用户积分</th>
                    </tr>
                @if(count($application)==0)
                    <tr>
                        <td colspan="4">申请提现为零</td>
                    </tr>
                @else
                    @foreach($application as $application)
                    
                    <tr>
                        <td>{{$application->created_at}}</td>
                        <td>{{$application->username}}</td>
                        <td>{{$application->point}}</td>
                        <td><a onclick="javascript:if(confirm('确定要删除此信息吗？')){alert('删除成功！');return true;}return false;" href="{{ asset('/admin/application')}}/{{$application->id}}"><button type="submit" class="btn btn-danger" >删除记录</button></a></td>
                    </tr>
                    @endforeach
                @endif
                </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
