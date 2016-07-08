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
                    <tr>
                        <td>111</td>
                        <td>xx天</td>
                        <td>xx天</td>
                        <td>xx天</td>
                    </tr>
                    <tr>
                        <td>111</td>
                        <td>xx天</td>
                        <td>xx天</td>
                        <td>xx天</td>
                    </tr>
                    <tr>
                        <td>111</td>
                        <td>xx天</td>
                        <td>xx天</td>
                        <td>xx天</td>
                    </tr>
                   
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection