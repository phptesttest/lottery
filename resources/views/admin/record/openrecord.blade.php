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
                <h3 class="panel-title">开奖记录</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>期号</th>
                        <th>开奖号码</th>
                        <th>总和值</th>
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