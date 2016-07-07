
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
        background-color: #B3B3B3;
    }
    .dropdown-menu{
        background-color: #B3B3B3;
    }
    @yield('headder')
    </style>
</head>
<body id="app-layout" style='padding-top:100px;'>
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
            <a class="navbar-brand" >后台管理系统</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">开奖记录</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户管理<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">用户充值</a></li>
                        <li><a href="#">用户查询</a></li>
                        <li><a href="#">账号生成</a></li>
                        <li><a href="#"></a></li>
                    </ul>
                </li>
                <li><a href="#">下注记录</a></li>
                <li><a href="#">结算管理</a></li>
                <li><a href="#">充值记录</a></li>
                <li><a href="#">退出</a></li>
            </ul>
        </div>
    </div>
</nav>
    @yield('content')

</body>
</html>


