@extends('layouts.masters.login')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <h3 class="text-center mb-4">益得紡織-登入介面</h3>
                    <form id="login-form" action="{{Route('post_login')}}" method="POST" class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id"><i class="fas fa-user"></i> 員工編號</label>
                            <br>
                            <select class="form-control" id="employee_account" name="employee_account" required>
                                <option value="">客戶</option>
                                @foreach($data as $row)
                                    <option value="{{$row->account}}">{{$row->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="employee_password"><i class="fas fa-key"></i> 員工密碼</label>
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
                        <div class="form-group">
                            <a id="btn_download_apk" href="{{route('download_apk')}}"
                               class="btn btn-secondary rounded px-3 form-control text-white">
                                掃描器下載(限Android)
                            </a>
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

            //若非iphone手機則隱藏掃描器按鈕
            let agent = navigator.userAgent.toLowerCase();
            if (!agent.includes("android")) {
                document.getElementById("btn_download_apk").style.display = "none";
            }

            //submit button
            btn_submit.addEventListener('click', function () {

                form_submit.submit();
            })

            $("#employee_account").editableSelect({efficts: 'slide'})

            $("#employee_account").on('select.editable-select',function(e){
                console.log(e);
                if($("#employee_account").val() == '客戶'){
                    $("#employee_password").attr('placeholder','客戶不需輸入密碼');
                    $("#employee_password").prop('disabled',true);
                }else{
                    $("#employee_password").attr('placeholder','員工密碼');
                    $("#employee_password").prop('disabled',false);
                };
            }).editableSelect({efficts: 'slide'})

        })()
    </script>
@endsection
