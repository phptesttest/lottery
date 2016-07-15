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
            @if(count($opens)==0)

                  <p>还没有开奖信息</p>  

            @else
            <div class='table-responsive'>
            <table class="table">
                    <tr>
                        <th>期号</th>
                        <th>时间</th>
                        <th>开奖号码</th>
                        <th>总和值</th>
                    </tr>
            @foreach($opens as $open)
                <tr>
                <td class="period"><?php echo $open->period ?></td>
                <td class="period"><?php echo $open->time ?></td>
                <td>
                <?php
                    $all=0; 
                    $arr=stringToArray($open->number);
                    foreach ($arr as $key => $value) {
                        $all=$all+$value;
                ?>

                        <?php echo $value." ";?>
                <?php
                    }
                ?>
                </td>
                <td><?php echo $all ?></td>
                </tr>
                @endforeach
                </table>
                </div>
                @endif
                <div class="page"><?php echo $opens->render(); ?></div>
            </div>
        </div>
    </div>
    
</div>
@endsection