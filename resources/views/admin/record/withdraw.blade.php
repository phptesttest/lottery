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
                <h3 class="panel-title">提现记录</h3>
            </div>
            <div class="panel-body">
            <div class='table-responsive'>
                <table class="table">
                    <tr>
                        <th>时间</th>
                        <th>提现用户</th>
                        <th>提现积分</th>
                        <th>操作</th>
                    </tr>
                @if(count($withdraw)==0)
                    <tr>
                        <td colspan="4">提现记录为零</td>
                    </tr>
                @else
                    @foreach($withdraw as $withdraw)
                    <?php 
                        if ($withdraw->withdraw_num!=0) {
                    ?>
                    <tr>
                        <td>{{$withdraw->created_at}}</td>
                        <td>{{$withdraw->username}}</td>
                        <td>{{$withdraw->withdraw_num}}</td>
                        <td><a onclick="javascript:if(confirm('确定要删除此信息吗？')){alert('删除成功！');return true;}return false;" href="{{ asset('/admin/withdraw')}}/{{$withdraw->id}}"><button type="submit" class="btn btn-danger">删除</button></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                        
                    @endforeach
                @endif
                </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
