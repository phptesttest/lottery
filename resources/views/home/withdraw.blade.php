@extends('home/nav')
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
                <h3 class="panel-title">申请提现</h3>
            </div>
            <div class="panel-body">
            <div class='table-responsive'>
                <table class="table">
                    <tr>
                        <th>个人名称</th>
                        <th>个人积分</th>
                    </tr>
                    <tr>
                        <td>{{$username}}</td>
                        <td>{{$point}}</td>
                    </tr>
                   <tr><td><a href="{{ asset('/withdraw')}}/{{$userid}}"><button type="submit" class="btn btn-primary" onclick="confirm('你确定要申请提现吗？')">申请提现</button></a></td></tr>
                </table>
                <p>申请提现后请联系客服，以客服结算时的金额为准。</p>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
