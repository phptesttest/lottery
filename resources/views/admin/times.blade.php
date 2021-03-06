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
                <h3 class="panel-title">赔率设定</h3>
            </div>
            <div class="panel-body">
            <form id="form2" action="{{ asset('/admin/times')}}" method="POST" onsubmit = "return checkUser();">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <table class="table">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>                            
                                <li>{{ $errors }}</li>
                            </ul>
                        </div>
                    @endif
                        <tr>
                            <th>第几球</th>
                            <td><select name='ball'>
                                <option value="1" selected="selected">第一球</option>
                                <option value="2">第二球</option>
                                <option value="3">第三球</option>
                                <option value="4">第四球</option>
                                <option value="5">第五球</option>
                                <option value="6">总分</option>
                            </select></td>
                        </tr>
                        <tr>
                            <th>号码</th>
                            <td><select name="type">
                                <option value="大">大</option>
                                <option value="小">小</option>
                                <option value="单">单</option>
                                <option value="双">双</option>
                            </select></td>
                            
                        </tr>
                        <tr>
                            <th>赔率</th>
                            <td><input id="point" type='text' class='form-control' name="rate"></td>
                        </tr>
                        <tr>
                             <th>操作</th>
                             <td><input type="submit" class='btn btn-info' value="设定赔率"></td>
                        </tr>
                    </table>
            </form>
            </div>
        </div>
    </div>
    
</div>
<script type="text/javascript">
   function checkUser(){
        var point=$("#point").val();
        if (point>0&&point<100) {
            return true;
        }
        else{
            alert('请输入数字且大于零');
            return false;
        }
        
   } 
</script>
@endsection
