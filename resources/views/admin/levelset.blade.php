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
    input{
        width:100px;
    }
@endsection
@section('content')
<div class="container">
    <div class="col-xs-12 col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">下注等级设定</h3>
            </div>
            <div class="panel-body">
                <div class="responsive">
                <form action="{{ asset('/admin/levelsetFun') }} " method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table class="table">
                    <tr>
                        <td>
                            <select class="form-control" name="level">
                              <option value="1" selected="selected">等级1</option>
                              <option value="2">等级2</option>
                              <option value="3">等级3</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>最大下注金额：<input type="text" name='max' onkeyup="if(event.keyCode !=37 && event.keyCode != 39){if (! /^\d+$/ig.test(this.value)){this.value='';}}" /></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="设定" class="btn btn-info" /></td>
                    </tr>
                </table>
                </form>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">下注等级及限度如下：</h3>
            </div>
            <div class="panel-body">
                <div class="responsive">
                <table class="table">
                    @foreach( $levels as $level)
                    <tr>
                        <td>等级{{$level->id}}最大限度为:</td>
                        <td>{{$level->max}}</td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
