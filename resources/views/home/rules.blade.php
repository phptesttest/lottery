@extends('home/nav')
@section('yangshi')
	.showtext{
		width:450px;
		height:auto;
	}
@endsection()
@section('content')
	<div class="container">
    <div class="col-xs-12 col-sm-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">游戏规则如下：</h3>
            </div>
            <div class="panel-body">
				<div class="table-responsive">
					<div id='showtext'>
						@if(count($rule)==0)
							<p>你还没有发布游戏规则</p>
						@else
						<p><pre>{{$rule->content}}</pre></p>
						@endif
					</div>
				</div>
            </div>
        </div>
    </div>
  
</div>
@endsection
               