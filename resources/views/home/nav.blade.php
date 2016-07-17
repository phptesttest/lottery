
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
    .navbar-brand{
        cursor: pointer;
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
            <a class="navbar-brand" onclick="window.history.go(-1)" ><span class='glyphicon glyphicon-arrow-left'></span></a>
            <a class='navbar-brand' onclick="window.location.reload()"><span class='glyphicon glyphicon-refresh'></span ></a>
            <a class='navbar-brand' onclick="window.history.go(1)"><span class='glyphicon glyphicon-arrow-right' ></span></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/index">彩票结果</a></li>
                <li><a href="/buy">彩票下注</a></li>
                <li><a href="/rules">游戏规则</a></li>
                <li><a href="javascript:void(0)" id="reload">刷新</a></li>
                <li><a href="/logout">退出</a></li>
            </ul>
        </div>
    </div>
</nav>
@yield('content')

@yield('script')
<script type="text/javascript">
    $("#reload").click(function(){
        window.location.reload(); 
    });
    
</script>
</body>
</html>


