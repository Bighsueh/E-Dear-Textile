@extends('layouts.masters.login')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">益得紡織-登入介面</h3>
                    <form id="login-form" action="{{Route('post_login')}}" method="POST" class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">員工編號</label>
                            <br>
                            <input id="employee_id" name="employee_id" type="text" class="form-control rounded-left"
                                   placeholder="員工編號"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="employee_password">員工密碼</label>
                            <br>
                            <input id="employee_password" name="employee_password" type="password"
                                   class="form-control rounded-left"
                                   placeholder="員工密碼" required>
                        </div>
                        <div class="form-group">
                            <button id="btn_submit" type="button"
                                    class="form-control btn btn-secondary rounded submit px-3">登入
                            </button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        ;(function () {
            let btn_submit = document.getElementById('btn_submit');
            let form_submit = document.getElementById('login-form');

            btn_submit.addEventListener('click', function () {

                form_submit.submit();
            })
        })()
    </script>
@endsection
