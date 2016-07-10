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
    padding:50px 30px 0px 30px;
    padding-bottom: 40px;
    color: #5a5a5a;
    background-color: #ddd;
    }
    .navbar-nav li a{
        color:white;
    }
     @yield('yangshi');
     
    </style>
</head>
<body id="app-layout" style='padding-top:50px;'>
  

    @yield('content')

</body>
</html>