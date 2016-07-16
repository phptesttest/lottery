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
                <h3 class="panel-title">普通管理员充值</h3>
            </div>
            <div class="panel-body">
            <form action="{{ asset('/admin/adminpayFun')}}" method="POST" onsubmit = "return checkUser();">
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
                        <td>请输入要充值的管理员账号</td>
                        <td><input id="account" type='text' name="account"></td>
                    </tr>
                    <tr>
                        <td>请输入充值的积分</td>
                        <td><input id="point" type='text' name="point"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="确定充值"></td>
                    </tr>
                </table>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function checkUser(){
        var point=$("#point").val();
        var account=$("#account").val();
        var s = /^[0-9]*$/;
        if(s.test(point)){
            if (point==0) {
                alert("金额不能为零，请输入充值金额");
                return false;
            }
            if (account=="") {
                alert("请输入要充值的账号");
                return false;
            }
            else{
                return true;

            }
        }
        else{
            alert("充值金额，请输入数字");
            return false;
        }
   }
</script>
@endsection