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
                <h3 class="panel-title">结算管理</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>用户名</th>
                        <th>剩余积分</th>
                        <th>操作</th>
                    </tr>
                @if(count($users)==0)
                    <tr>
                        <td colspan="4">尚未有充值记录</td>
                    </tr>
                @else
                    @foreach($users as $users)
                        <tr>
                            <td>{{$users->username}}</td>
                            <td>{{$users->point}}</td>
                            <td><button type="submit" class="btn btn-danger">删除</button></td>
                        </tr>
                    @endforeach
                @endif
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection
