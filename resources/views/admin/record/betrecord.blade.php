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
                <h3 class="panel-title">用户下注记录</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>用户名</th>
                        <th>下注时间</th>
                        <th>下注内容</th>
                        <th>操作</th>
                    </tr>

        @if(count($bets)==0)
                    <tr>
                        <td colspan="4">目前下注记录为零</td>
                    </tr>
        @else
            @foreach($bets as $bets)
                    <tr>
                        <td>{{ $bets->username }}</td>
                        <td>{{ $bets->created_at }}</td>
                        <td>{{ $bets->content }}</td>
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