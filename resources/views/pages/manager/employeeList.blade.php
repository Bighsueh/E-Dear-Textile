@extends('layouts.masters.manager')
@section('content')
    <div class="container ">
        <div class="row form-inline form-group">
            <div class="input-group col-sm-8 col-8">
                <input type="text" class="form-control" placeholder="搜尋員工關鍵字" aria-label=""
                       aria-describedby="basic-addon1" name="search_parameter" id="search_parameter">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button" id="btn_search">搜尋</button>
                </div>
            </div>
            <div class="col-sm-4 col-4 row">
                <button type="button" class="btn btn-outline-secondary mx-1 col col-sm text-center"
                        data-toggle="modal" data-target="#CreateUserModal">新增員工
                </button>
                <button type="button" class="btn btn-outline-secondary mx-1 col col-sm text-center" id="btn_setting">
                    員工設定
                </button>
            </div>

        </div>

    </div>
    <div style="" class="container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>職位</th>
                <th>姓名</th>
                <th id="th_function">工作明細</th>
            </tr>
            </thead>
            <tbody id="tbody">
            </tbody>

        </table>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="CreateUserModal" tabindex="-1" role="dialog" aria-labelledby="CreateUserModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreateUserModalLongTitle">新增使用者</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row form-group">
                            <label for="create_level" class="col-sm-4 text-right">選擇職位</label>
                            <select class="form-control col-sm-6" aria-label="Default select example"
                                    name="create_level" id="create_level">
                                <option value="employee">員工</option>
                                <option value="manager">幹部</option>
                            </select>
                        </div>
                        <div class="row form-group">
                            <label for="create_name" class="col-sm-4 text-right">請輸入名稱</label>
                            <input type="text" name="create_name" id="create_name" class="form-control col-sm-6"
                                   placeholder="員工名稱"/>
                        </div>
                        <div class="row form-group">
                            <label for="create_account" class="col-sm-4 text-right">請輸入帳號</label>
                            <input type="text" name="create_account" id="create_account" class="form-control col-sm-6"
                                   placeholder="帳號"/>
                        </div>
                        <div class="row form-group">
                            <label for="create_password" class="col-sm-4 text-right">請輸入密碼</label>
                            <input type="text" name="create_password" id="create_password" class="form-control col-sm-6"
                                   placeholder="密碼"/>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" id="btn_create_user">新增使用者</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="EditUserModal" tabindex="-1" role="dialog" aria-labelledby="EditUserModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditUserModalLongTitle">編輯使用者</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row form-group">
                            <label for="edit_level" class="col-sm-4 text-right">選擇職位</label>
                            <select class="form-control col-sm-6" aria-label="Default select example"
                                    name="edit_level" id="edit_level">
                                <option value="employee">員工</option>
                                <option value="manager">幹部</option>
                            </select>
                        </div>
                        <div class="row form-group">
                            <label for="create_name" class="col-sm-4 text-right">請輸入名稱</label>
                            <input type="text" name="edit_name" id="edit_name" class="form-control col-sm-6"
                                   placeholder="員工名稱"/>
                        </div>
                        <div class="row form-group">
                            <label for="edit_account" class="col-sm-4 text-right">請輸入帳號</label>
                            <input type="text" name="edit_account" id="edit_account" class="form-control col-sm-6"
                                   placeholder="帳號"/>
                        </div>
                        <div class="row form-group">
                            <label for="edit_password" class="col-sm-4 text-right">請輸入密碼</label>
                            <input type="text" name="edit_password" id="edit_password" class="form-control col-sm-6"
                                   placeholder="密碼"/>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" id="btn_edit_user">儲存編輯</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let setting_mode = "list";

        update_data();

        //資料刷新
        function update_data(search_parameter = null) {
            let url = '{{route('get_employee_data')}}';
            if (search_parameter !== null) {
                url += '?search_parameter=' + search_parameter;
            }

            $.ajax({
                url: url,
                method: 'GET',
                data: '',
                success: function (res) {
                    // console.log(res)
                    let thread = 1;
                    $("#tbody tr").remove();
                    if (res.length > 0) {
                        res.forEach(function (row) {
                            let row_thread = "<td>" + (thread++) + "</td>";
                            let row_id = row['user_id'];
                            let row_level = "<td>" + row["level"] + "</td>";
                            let row_name = "<td>" + row["name"] + "</td>";
                            let row_function = "";
                            if (setting_mode === "list") {
                                row_function = "<td><a class='btn btn-outline-secondary'>查看</a></td>";
                            }
                            if (setting_mode === "setting") {
                                row_function =
                                    `<td class=''><buttun class='btn btn-outline-danger mr-2 btn_remove_user' value='${row_id}' >刪除</buttun>` +
                                    `<buttun class='btn btn-outline-info btn_edit_user' value='${row_id}'>修改資訊</buttun></td>`;
                            }
                            $("tbody").append(
                                "<tr>" + row_thread + row_level + row_name + row_function + "</tr>"
                            );
                        });
                    }
                    if (res.length === 0) {
                        $("tbody").append(
                            "<tr><td colspan='4' class='text-center'>查無資料</td></tr>"
                        );
                    }

                    //修凱modal
                    $(".btn_edit_user").click(function(){
                        open_edit_user_modal($(this).attr("value"));
                    })
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }

        function open_edit_user_modal(id){
            $.ajax({
                url:'{{route('get_edit_data')}}?user_id='+id,
                method:'get',
                data:'',
                success:function (res) {
                    console.log(res);
                    // $("#edit_level").val('employee');
                    // $("#edit_name").val('');
                    // $("#edit_account").val('');
                    // $("#edit_password").val('');
                }

            })
        }

        $(".btn_edit_user").click(function(){
            window.alert('123');
        })
        $("#btn_setting").click(function () {
            if (setting_mode === "list") {
                setting_mode = "setting";
                $("#th_function").text("設定");
            } else {
                setting_mode = "list";
                $("#th_function").text("工作明細");

            }
            update_data();
        });

        $("#btn_search").click(function () {
            let search_parameter = $("#search_parameter").val();
            update_data(search_parameter);
        })

        $("#btn_create_user").click(function () {
            $.ajax({
                url: '{{route('create_user_data')}}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    create_level: $("#create_level").val(),
                    create_name: $("#create_name").val(),
                    create_account: $("#create_account").val(),
                    create_password: $("#create_password").val(),
                },
                success: function (res) {
                    if (res === "success") {
                        window.alert("新增成功");
                    }
                    $("#create_level").val('employee');
                    $("#create_name").val('');
                    $("#create_account").val('');
                    $("#create_password").val('');
                    update_data();
                },
                error: function (err) {
                    window.alert('新增失敗：\n' + err['responseJSON']["message"]);
                    console.log(err['responseJSON']["message"]);

                }
            })
        })



    </script>


@endsection
