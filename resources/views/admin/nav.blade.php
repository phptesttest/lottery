<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style>
    body {
    padding-top: 50px;
    padding-bottom: 40px;
    color: #5a5a5a;
    }
    .navbar-nav li a{
        color:white;
    }
    .navbar{
        background-color: rgba(151, 168, 173, 0.32);
        color:white;
    }
    .dropdown-menu{
        background-color: #B3B3B3;
    }
    .navbar-brand{
        cursor: pointer;
    }
    @yield('headder')
    </style>
</head>
<body id="app-layout" style='padding-top:70px;'>
    <nav class="navbar navbar-default navbar navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ asset('/admin/index')}}">后台</a>
            <a class="navbar-brand" onclick="window.history.go(-1)" ><span class='glyphicon glyphicon-arrow-left'></span></a>
            <a class='navbar-brand' onclick="window.location.reload()"><span class='glyphicon glyphicon-refresh'></span ></a>
            <a class='navbar-brand' onclick="window.history.go(1)"><span class='glyphicon glyphicon-arrow-right' ></span></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户管理<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ asset('/admin/userlist')}}">用户列表</a></li>
                        <li><a href="{{ asset('/admin/pay')}}">用户充值</a></li>
                        <li><a href="{{ asset('/admin/search')}}">用户查询</a></li>
                    </ul>
                </li>
                @if(Session::has('big'))
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">普通管理员管理<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ asset('/admin/adminlist')}}">普通管理员列表</a></li>
                        <li><a href="{{ asset('/admin/adminpay')}}">普通管理员充值</a></li>
                        
                    </ul>
                </li>
               @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">记录管理<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ asset('/admin/recharge')}}">充值记录</a></li>
                        <li><a href="{{ asset('/admin/betrecord')}}">下注记录</a></li>
                        <li><a href="{{ asset('/admin/openrecord')}}">开奖记录</a></li>
                        <li><a href="{{ asset('/admin/withdraw')}}">提现记录</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">规则设定<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ asset('/admin/rules')}}">游戏规则设定</a></li>
                        <li><a href="{{ asset('/admin/buylevel')}}">用户下注等级设定</a></li>
                    </ul>
                </li>
                <li><a href="{{ asset('/admin/account')}}">结算管理</a></li>
                <li><a href="{{ asset('/admin/times')}}">赔率设置</a></li>
                <li><a href="{{ asset('/admin/application')}}">查看提现申请</a></li>
                <li><a href="{{ asset('/admin/logout')}}">退出</a></li>
            </ul>
        </div>
    </div>
</nav>
@yield('content') 
</script>
</body>
</html>


