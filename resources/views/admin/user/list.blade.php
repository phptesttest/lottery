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
    .container{
        padding:0px;
    }
    .respondcontainer{
        padding:0px;
    }
@endsection
<?php 

?>
@section('content')
	<div class="container">
    <div class="col-xs-12 col-sm-12" class="respondcontainer">
        <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">生成用户邀请码</h3>
                </div>
                <div class="panel-body">
                <form id="form1" action="{{ asset('/admin/userlist')}}" method="POST" onsubmit = "return checkUser();">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class='table-responsive'>
                    <table class="table">
                        <tr>
                            <th>下注等级</th>
                            <th>初始积分</th>
                        </tr>
                        <tr>
                            <td><select name='level' class="form-control">
                                <option value="1" selected="selected">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select></td>
                            <td><input id="point" class="enterPoint" type='text' name='point'></td>
                            
                        </tr>
                        <tr>
                            <td><input type="submit" id="submit" value="确定生成" class="btn btn-info"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <strong>PS:</strong>等级1：最大下注金额为100元
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">等级2：最大下注金额为1000元</td>
                        </tr>
                        <tr>
                            <td colspan="2">等级3：最大下注金额为10000元</td>
                        </tr>
                    </table>
                    </div>
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
                    <div class='table-responsive'>
                    <table class="table">

                    <tr>
                        <th>用户账号</th>
                        <th>用户积分</th>
                        @if(Session::has('big'))
                        <th>操作</th>
                        @endif
                    </tr>
                   

                
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->username}}</td>
                            <td>{{ $user->point}}</td>
                            @if(Session::has('big'))
                            <td><a onclick="javascript:if(confirm('确定要删除此信息吗？')){alert('删除成功！');return true;}return false;" href="{{ asset('/admin/userlist')}}/{{$user->id}}"><button class="btn btn-danger">删除</button></a></td>
                            @endif
                        </tr>
                    @endforeach
                    </table>
                    </div>
                @endif
                
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">

   function checkUser(){
        var point=$("#point").val();
        var s = /^[0-9]*$/;
        if(s.test(point)){
            alert("账号生成成功");
            return true;       
        }
        else{
            alert("请输入数字");
            return false;
        }
   } 
</script>
@endsection