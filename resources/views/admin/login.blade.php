@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading " >欢迎来到后台登陆系统</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> 你的输入可能存在一些错误.<br><br>
							<ul>
								
								<li>{{ $errors }}</li>
								
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/logindeal') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">管理员账号</label>
							<div class="col-md-6">
								<input type="name" class="form-control" name="adname" value="{{ old('adname') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">管理员密码</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">记住我
                                    </label>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">登录</button>

								<a class="btn btn-link" href="#">忘记你的密码?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
