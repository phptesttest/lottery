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
                    <h3 class="panel-title">账号生成</h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>下注等级</th>
                            <th>用户账号</th>
                            <th>用户密码</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td><select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select></td>
                            <td><input type='text' onfocus = "javascript:this.blur()" ></td>
                            <td><input type='text' onfocus = "javascript:this.blur()" ></td>
                            <td><button type='submit'>确认生成</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">用户列表信息</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>用户账号</th>
                        <th>用户密码</th>
                        <th>用户积分</th>
                        <th>操作</th>
                    </tr>
                    <tr>
                        <td>账号1</td>
                        <td>xx</td>
                        <td>xx</td>
                        <td>xx</td>
                    </tr>
                    <tr>
                        <td>账号1</td>
                        <td>xx</td>
                        <td>xx</td>
                        <td>xx</td>
                    </tr>
                    <tr>
                        <td>账号1</td>
                        <td>xx</td>
                        <td>xx</td>
                        <td>xx</td>
                    </tr>
                    <tr>
                        <td>账号1</td>
                        <td>xx</td>
                        <td>xx</td>
                        <td>xx</td>
                    </tr>
                   
                </table>
            </div>
        </div>
    </div>

</div>
@endsection