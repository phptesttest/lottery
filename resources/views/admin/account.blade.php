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
                <div class='table-responsive'>
                <table class="table">
                @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>                            
                                <li>{{ $errors }}</li>
                            </ul>
                        </div>
                    @endif
                    <tr>
                        <th>用户名</th>
                        <th>剩余积分</th>
                        @if(Session::has('big'))
                        <th>操作</th>
                        @endif
                    </tr>
                @if(count($users)==0)
                    <tr>
                        <td colspan="4">目前没有用户</td>
                    </tr>
                @else
                    @foreach($users as $user)
                        <?php if ($user->point!=0) {?>
                        <tr>
                            <td>{{ $user->username}}</td>
                            <td>{{ $user->point}}</td>
                            @if(Session::has('big'))
                            <td><a href="{{ asset('/admin/account')}}/{{ $user->id}}"><button type="submit" class="btn btn-info">提现</button></a></td>
                            @endif
                        </tr>
                        <?php } ?>
                    @endforeach
                @endif
                </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
