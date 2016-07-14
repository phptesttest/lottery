@extends('app')
@section('yangshi')

@endsection()
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading " >欢迎你的来到！</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>登录失败!</strong> 您的输入存在一些问题.<br><br>
								<li>{{ $errors }}</li>
							</ul>
						</div>
					@endif


					<form class="form-horizontal" role="form" method="POST" action="{{ asset('/logindeal') }}">
						
						<input type="hidden" method='post' name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">用户名</label>
							<div class="col-md-4">
								<input type="name" class="form-control" name="username" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">密码</label>
							<div class="col-md-4">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<input type="submit" value='登陆' class="btn btn-primary">
							</div>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
