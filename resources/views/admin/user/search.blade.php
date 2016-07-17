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
            <form action="{{ asset('/admin/search')}}" method="POST" onsubmit = "return checkUser();">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                        <td class="col-md-4 control-label">请输入你要查询的账号</td>
                    </tr>  
                    <tr>
                    <td class="col-md-6"><input id="account" type='text'  class="form-control" name="account"></td>
                    </tr> 
                    <tr>
                        <td><input type="submit" class='btn btn-info' value="查询"></td>
                    </tr>
                </table>
                </div>
                </form>
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
                        <div class='table-responsive'>
                        <table class="table">

                            <tr>
                                <th>用户账号</th>
                                <th>用户密码</th>
                                <th>用户积分</th>
                            </tr>
                            <tr>
                                <td>{{ $user->username}}</td>
                                <td>{{ $user->password}}</td>
                                <td>{{ $user->point}}</td>
                            </tr>

                        </table>
                        </div>
                    @endif
                    
                </div>
            </div>
        <div>
     <?php
            
        }
                 
    ?>
</div>
<script type="text/javascript">
    function checkUser(){
        var account=$("#account").val();
  
        if (account=="") {
            alert("请输入你要查询的账号");
            return false;
        }
        else{
            return true;
        }
            
   }
</script>
@endsection