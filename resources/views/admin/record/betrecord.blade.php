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
                        <th>下注期数</th>
                        <th>下注时间</th>
                        <th>下注类型</th>
                        <th>金额</th>
                        <th>操作</th>
                    </tr>

        @if(count($bets)==0)
                    <tr>
                        <td colspan="4">目前下注记录为零</td>
                    </tr>
        @else
            @foreach($bets as $bet)
                    <tr>
                        <td>{{ $bet->username }}</td>
                        <td>{{ $bet->period }}</td>
                        <td>
                            <?php 
                                $arr=explode(" ",$bet->created_at);
                                echo $arr[1];
                            ?>    
                        </td>
                        <td>
                            <?php
                                if ($bet->cId==1) {
                                   $ball="第1球";
                                }
                                if ($bet->cId==2) {
                                   $ball="第2球";
                                }
                                if ($bet->cId==3) {
                                   $ball="第3球";
                                }
                                if ($bet->cId==4) {
                                   $ball="第4球";
                                }
                                if ($bet->cId==5) {
                                   $ball="第5球";
                                }
                                if ($bet->cId==6) {
                                   $ball="总和";
                                }
                                echo $ball.$bet->cName;
                            ?>
                        </td>
                        <td>{{ $bet->number }}</td>
                        <td><a href='/admin/betrecord/{{ $bet->id}}'><button class="btn btn-danger">删除</button></a></td>
                    </tr>
            @endforeach
        @endif  
                    
                    
                   
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection