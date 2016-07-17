@extends('admin/nav')
@section('headder')
    .panel{
        border:2px solid #ccc;
        box-shadow:3px 3px #cccc;
    }
    #setrules{
        width:100%;
        height:150px;
        border:1px solid #ccc;
        font-size:16px;
        margin-bottom:15px;
        overflow:scroll;
    }
@endsection
@section('content')
    <div class="container">
    <div class="col-xs-12 col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">游戏规则设定</h3>
            </div>
            <div class="panel-body">
            <p>请在以下输入框输入你想设定的游戏规则</p>
            <form action="{{ asset('/admin/setrules')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class='table-responsive'>
                     <textarea id='setrules' name='content'></textarea>   
                </div>
                <input type="submit" class='btn btn-info' value="发布游戏规则">
            </form>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">游戏规则列表</h3>
            </div>
            <div class="panel-body">
                @if(count($rules)==0)
                  <p>您还没有制定游戏规则</p>  
                @else
                    <div class='table-responsive'>
                    <table class="table">
                    <tr>
                        <th>游戏规则</th>
                        <th>时间</th>
                        <th>操作</th>
                    </tr>
                @foreach($rules as $rule)
                        <tr>
                            <td><div>{{$rule->content}}</div></td>
                            <td>{{$rule->created_at}}</td>
                            <td><a href='/admin/deleterules/{{$rule->id}}'><button class="btn btn-danger">删除</button></a></td>
                        </tr>
                @endforeach
                    </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    </div>
    
</div>
@endsection
