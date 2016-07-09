@extends('admin/nav')
@section('headder')
	.panel{
		border:2px solid #ccc;
		box-shadow:3px 3px #cccc;
        margin-top:20px;
	}
@endsection
@section('content')
<div class="container">
    <div class="col-xs-12 col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">用户信息查询</h3>
            </div>
            <div class="panel-body">
            <form action="{{ asset('/admin/search')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table class="table">
                    <tr>
                        <td>请输入你要查询的账号</td>
                        <td><input type='text' name="account"></td>
                        <td><input type="submit" value="查询"></td>
                    </tr>   
                </table>
                </form>
            </div>
        </div>
    </div>
</div>
    <?php 

        if (isset($user)) {
    ?>
        <div class="col-xs-12 col-sm-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">查询结果</h3>
                </div>
                <div class="panel-body">

                    @if(count($user)==0)

                      <p>该账号不存在！</p>  

                    @else
                        <table class="table">

                            <tr>
                                <th>用户账号</th>
                                <th>用户密码</th>
                                <th>用户积分</th>
                                <th>操作</th>
                            </tr>
                            <tr>
                                <td>{{ $user->username}}</td>
                                <td>{{ $user->password}}</td>
                                <td>{{ $user->point}}</td>
                                <td><button>删除</button></td>
                            </tr>

                        </table>
                    @endif
                    
                </div>
            </div>
        <div>
     <?php
            
        }
                 
    ?>
@endsection