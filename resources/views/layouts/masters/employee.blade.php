<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <title>益得紡織員工介面</title>

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

</head>
<body class="bg-light h-100">
<style>
    *{
        font-size:20px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">益得紡織-員工介面</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="text-light nav-link active" aria-current="page"
                       href="{{Route('get_employee_menu')}}">派遣單列表</a>
                </li>

                <li class="nav-item">
                    <a class="text-light nav-link active" aria-current="page"
                       onclick="employeeQrcodeButtonClick()">員工QR code</a>
                </li>
                <li class="nav-item">
                    <a class="text-light nav-link active" aria-current="page"
                       onclick="window.location.href='app://open'">QR code掃描器</a>
                    <input id="camera_link_for_iphone" type="file" accept="image/*" style="display: none" capture/>
                </li>
                <li class="nav-item">
                    <a id="btn_download_scanner_apk" class="text-secondary nav-link">掃描器下載</a>
                </li>
                <li class="nav-item">
                    <a class="text-secondary nav-link" href="{{Route('get_login')}}">登出</a>
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
                {{--                </li>--}}
            </ul>
            <button type="button" id="employeeQrcodeButton" data-toggle="modal" data-target="#EmployeeQrcode"
                    style="display: none;visibility: hidden"></button>
            <script>
                // employeeQrcodeButton click
                function employeeQrcodeButtonClick() {
                    document.getElementById('employeeQrcodeButton').click();
                }

                //開啟掃描器
                $("btn_qrcode_scanner").click(function () {
                    //獲取系統裝置資訊
                    let agent = navigator.userAgent.toLowerCase();

                    //若裝置為 Android
                    if (agent.includes("android")) {
                        window.location.href = "app://open";
                    }
                    //若裝置為 iphone
                    else if (agent.includes("iphone")) {
                        document.getElementById("camera_link_for_iphone").click();
                    }
                    //其他裝置
                    else {
                        window.alert("此功能僅限於Android或ios裝置使用!");
                    }
                })

                //下載掃描器
                document.getElementById("btn_download_scanner_apk").addEventListener("click",function (){
                    let agent = navigator.userAgent.toLowerCase();
                    if (!agent.includes("android")) {
                        if (window.confirm("此掃描器軟體僅安卓(android)手機需要下載，請問仍要下載嗎?")) {
                            window.location.href = "{{route('download_apk')}}";
                        }
                    }
                })

            </script>
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
<!-- Modal -->
<div class="modal fade" id="EmployeeQrcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel" style="">員工QR code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div id="employeeQrcodeImg"></div>
                    <script>
                        $("#employeeQrcodeImg").qrcode("{{url('/afterScan?user_id=')}}{{\Illuminate\Support\Facades\Session::get('user_id')}}");
                    </script>
                </div>
            </div>
            <div class="modal-footer">
                {{--                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
            </div>
        </div>
    </div>
</div>

</body>

</html>
