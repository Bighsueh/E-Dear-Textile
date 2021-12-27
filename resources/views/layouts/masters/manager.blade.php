<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <title>益得紡織幹部介面</title>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.qrcode.min.js') }}"></script>
    <script src="{{ asset('assets/js/qrcode.js') }}"></script>
    {{-- editable-select   --}}
    <link href="{{asset('assets/css/jquery-editable-select.css')}}" rel="stylesheet"/>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-editable-select.js') }}"></script>

    {{--font-awesome--}}
    <script type="text/javascript" src="{{ asset('assets/js/font-awesome.js') }}"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
</head>
<body class="bg-light h-100">
<style>
    *{
        font-size:20px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">益得紡織-幹部管理介面</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link text-white" href="{{Route('get_menu')}}">派遣單列表</a>
            @if(\Illuminate\Support\Facades\Session::get('level') === \App\User::ROLE_ADMIN)
            <a class="nav-item nav-link text-white" id="navbar_ticket_setting">派遣單資料設定</a>
            <a class="nav-item nav-link text-white" href="{{Route('get_user_page')}}">員工列表</a>
            @endif
            <a class="nav-item nav-link" id="btn_download_scanner_apk">掃描器下載</a>
            <a class="nav-item nav-link" href="{{Route('get_login')}}">登出</a>
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
@include('pages.manager.TicketSettingModal')

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
