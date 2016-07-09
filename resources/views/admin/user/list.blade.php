@extends('admin/nav')
@section('headder')
	.panel{
		border:2px solid #ccc;
		box-shadow:3px 3px #cccc;
        margin-top:20px;
	}
    .enterCount{
        width:100px;
    }
    .enterPassword{
        width:100px;
    }
    .enterPoint{
        width:50px;
    }
@endsection
@section('content')
	<div class="container">
    <div class="col-xs-12 col-sm-6">
        <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">账号生成</h3>
                </div>
                <div class="panel-body">
                <form action="{{ asset('/admin/userlist')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table class="table">
                        <tr>
                            <th>下注等级</th>
                            <th>用户账号</th>
                            <th>用户密码</th>
                            <th>初始积分</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td><select name='level'>
                                <option value="1" selected="selected">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select></td>
                            <td><input class="enterCount" type='text' onfocus = "javascript:this.blur()" ></td>
                            <td><input class="enterPassword" type='text' onfocus = "javascript:this.blur()" ></td>
                            <td><input class="enterPoint" type='text' name='point'></td>
                            <td><input type="submit" value="确定生成"></td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>

            
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">用户列表信息</h3>
            </div>
            <div class="panel-body">

                @if(count($users)==0)

                  <p>您还没有生成用户账号！</p>  

                @else
                    <table class="table">

                    <tr>
                        <th>用户账号</th>
                        <th>用户密码</th>
                        <th>用户积分</th>
                        <th>操作</th>
                    </tr>
                   
                
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->username}}</td>
                            <td>{{ $user->password}}</td>
                            <td>{{ $user->point}}</td>
                            <td><button>删除</button></td>
                        </tr>
                    @endforeach
                    </table>
                @endif
                
            </div>
        </div>
    </div>

</div>
@endsection