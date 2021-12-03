<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <title>益得紡織幹部介面</title>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.qrcode.min.js') }}"></script>
    <script src="{{ asset('assets/js/qrcode.js') }}"></script>
    {{-- editable-select   --}}
    <link href="{{asset('assets/css/jquery-editable-select.css')}}" rel="stylesheet"/>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-editable-select.js') }}"></script>

</head>
<body class="bg-light h-100">
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
                    <a class="text-light nav-link" href="{{Route('get_user_page')}}">員工列表</a>
                </li>
                <li class="nav-item">
                    <a id="btn_download_scanner_apk" class="text-secondary nav-link" >掃描器下載</a>
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
<div class="wrapper ">
    <div class="content">

        <div class="mt-3">
            @yield('content')
        </div>
        {{--        <div class="footer text-center text-lg-start bg-dark text-muted"--}}
        {{--                style="position: relative;height: 50px;margin-bottom: -50px">--}}

        {{--        </div>--}}

    </div>
</div>


</body>
<script>
    document.getElementById("btn_download_scanner_apk").addEventListener("click",function(){
        let agent = navigator.userAgent.toLowerCase();
        if (!agent.includes("android")) {
            if (window.confirm("此掃描器軟體僅安卓(android)手機需要下載，請問仍要下載嗎?")) {
                window.location.href = "{{route('download_apk')}}";
            }
        }
    })
</script>
</html>
