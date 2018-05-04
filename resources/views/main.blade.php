<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <link href="/css/style.css" rel="stylesheet"/>
    <link href="/css/app.css" rel="stylesheet"/>


</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/weather">Погода</a></li>
                <li><a href="/orders">Заказы</a></li>
                <li><a href="/products">Продукты</a></li>
            </ul>
        </div>
    </div>
</nav>
@yield('content')
</body>
</html>
