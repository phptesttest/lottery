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
                <h3 class="panel-title">充值记录</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>充值用户</th>
                        <th>充值金额</th>
                        <th>时间</th>
                        <th>操作者</th>
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
