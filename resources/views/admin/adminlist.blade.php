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
<?php 

?>
@section('content')
	<div class="container">
    <div class="col-xs-12 col-sm-6">
        <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">管理员账号和密码生成</h3>
                </div>
                <div class="panel-body">
                <form action="{{ asset('/admin/adminlist')}}" method="POST" onsubmit = "return checkUser();">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class='table-responsive'>
                    <table class="table">
                        <tr>
                            <th>普通管理员初始积分</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td><input id="point" class="enterPoint" type='text' name='wPool'></td>
                            <td></td>
                            <td><input type="submit" value="确定生成" class="btn btn-info"></td>
                        </tr>
                    </table>
                    </div>
                    </form>
                </div>
            </div>

            
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">普通管理员列表信息</h3>
            </div>
            <div class="panel-body">

                @if(count($admins)==0)

                  <p>您还没有生成普通管理员账号！</p>  

                @else
                <div class='table-responsive'>
                    <table class="table">

                    <tr>
                        <th>普通管理员账号</th>
                        <th>普通管理员密码</th>
                        <th>普通管理员福利池积分</th>
                        <th>操作</th>
                    </tr>
                   
                    @foreach($admins as $admin)
                        <?php 
                            if ($admin->flag==2) {
                        ?>
                            <tr>
                            <td>{{ $admin->aName}}</td>
                            <td>{{ $admin->password}}</td>
                            <td>{{ $admin->wPool}}</td>
                            <td><a onclick="javascript:if(confirm('确定要删除此信息吗？')){alert('删除成功！');return true;}return false;" href="{{ asset('/admin/admindelete')}}/{{$admin->id}}"><button type="submit" class="btn btn-danger">删除</button></a></td>
                            </tr>
                        <?php
                             } 
                        ?>
                        
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