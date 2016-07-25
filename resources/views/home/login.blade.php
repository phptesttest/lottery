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
							<label class="col-md-4 control-label">请输入你的邀请码</label>
							<div class="col-md-4">
								<input type="name" class="form-control" name="username" value="<?php echo @$_COOKIE['username'];?>" >
								
							</div>
						</div>

						<!-- <div class="form-group">
							<label class="col-md-4 control-label">密码</label>
							<div class="col-md-4">
								<input type="password" class="form-control" name="password" value='<?php echo @$_COOKIE['password'];?>'>
							</div>
						</div> -->
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
  <?php if(@$_COOKIE['remember'] == 1){?><input type="checkbox" name="remember" value="1" checked><?php }else{(@$_COOKIE['remember'] == "")?><input type="checkbox" name="remember" value="1"><?php }?>
                                         记住我
                                    </label>
                                </div>
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
