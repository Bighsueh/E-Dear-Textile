<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <title>益得紡織幹部介面</title>
</head>
<body class="bg-light h-100" style="height: 100%;margin:0;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">益得紡織-幹部管理介面</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="text-light nav-link active" aria-current="page"
                       href="{{Route('get_menu')}}">派遣單列表</a>
                </li>
                <li class="nav-item">
                    <a class="text-light nav-link" href="{{Route('get_addSheet')}}">新增派遣單</a>
                </li>

                <li class="nav-item">
                    <a class="text-secondary nav-link" href="{{Route('get_login')}}">登出</a>
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
                {{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>
<div class="wrapper "
     style="min-height: 100%; /*外層高度100%*/
           margin-bottom: -50px; /*隨footer高度需做調整*/">
    <div class="content" style="padding-bottom: 50px;">

        <div class="mt-3">
            @yield('content')
        </div>
{{--        <div class="footer text-center text-lg-start bg-dark text-muted"--}}
{{--                style="position: relative;height: 50px;margin-bottom: -50px">--}}

{{--        </div>--}}

    </div>
</div>


</body>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</html>
