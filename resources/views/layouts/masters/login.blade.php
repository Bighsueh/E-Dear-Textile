<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{asset('assets/css/jquery-editable-select.css')}}" rel="stylesheet"/>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-editable-select.js') }}"></script>
    <title>益得紡織登入介面</title>
</head>
<body class="bg-light">
<style>
    *{
        font-size:20px;
    }
</style>
    @yield('content')
</body>
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</html>
