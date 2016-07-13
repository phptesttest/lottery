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
                <h3 class="panel-title">充值记录</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>充值用户</th>
                        <th>充值金额</th>
                        <th>时间</th>
                        <th>操作者</th>
                        <th>操作</th>
                    </tr>
                @if(count($recharges)==0)
                    <tr>
                        <td colspan="4">尚未有充值记录</td>
                    </tr>
                @else
                    @foreach($recharges as $recharges)
                        <tr>
                            <td>{{$recharges->username}}</td>
                            <td>{{$recharges->num}}</td>
                            <td>{{$recharges->created_at}}</td>
                            <td>{{$recharges->aName}}</td>
                            <td><a href='/admin/delRecharge/{{$recharges->id}}'><button class="btn btn-danger">删除</button></td>
                        </tr>
                    @endforeach
                @endif
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection
