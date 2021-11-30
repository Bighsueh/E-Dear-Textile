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
                <th class="col-sm-2">#</th>
                <th class="col-sm-3">職位</th>
                <th class="col-sm-3">姓名</th>
                <th class="col-sm-4" id="th_function">工作明細</th>
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
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
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
                    <input type="hidden" value="" name="edit_id" id="edit_id"/>

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
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
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
                    <button type="button" class="btn btn-outline-success" id="btn_store_edit_user">儲存編輯</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="DeleteUserModal" tabindex="-1" role="dialog" aria-labelledby="DeleteUserModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="DeleteUserModalLabel" style="">刪除使用者</h5>
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            確定要刪除以下使用者嗎？<br>
                            名稱：<a id="tag_delete_user_id"></a>
                        </div>
                        <input type="hidden" class="delete_user_id" id="delete_user_id"/>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" id="btn_delete_yes" class="btn btn-success">確定</button>
                    <button type="button" id="btn_delete_no" class="btn btn-danger close-modal">取消</button>
                </div>
            </div>
        </div>
        <script>
            //設定欄位狀態
            let setting_mode = "list";

            update_data();
            $(".close-modal").click(function () {
                $(".modal").modal('hide');
            });

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
                                let row_id = row['id'];
                                let row_level = "<td>" + row["level"] + "</td>";
                                let row_name = "<td class='user-name'>" + row["name"] + "</td>";
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

                        //修改modal
                        $(".btn_edit_user").click(function () {
                            open_edit_user_modal($(this).attr("value"));
                        })

                        //delete user data
                        $(".btn_remove_user").click(function () {
                            delete_user_name = $(this).parent().parent().find(".user-name").text();
                            $("#tag_delete_user_id").text(delete_user_name);
                            $("#delete_user_id").val($(this).attr("value"));
                            $("#DeleteUserModal").modal('show');
                        })
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }

            //刪除使用者
            function delete_user_data(id) {
                $.ajax({
                    url: '{{route('delete_edit_data')}}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: id,
                    },
                    success: function (res) {
                        update_data();
                    }

                })
            }


            //開啟edit_user_modal ->帶值進去
            function open_edit_user_modal(id) {
                $.ajax({
                    url: '{{route('get_edit_data')}}',
                    method: 'get',
                    data: {
                        user_id: id,
                    },
                    success: function (res) {
                        $("#edit_level").val('employee');
                        $("#edit_name").val(res[0]["name"]);
                        $("#edit_account").val(res[0]["account"]);
                        $("#edit_password").val(res[0]["password"]);
                        $("#edit_id").val(res[0]["id"]);
                        $("#EditUserModal").modal('show');
                    }

                })
            }

            //store 以編輯之edit_user_modal
            function store_edit_user_modal() {
                $.ajax({
                    url: '{{route('store_edit_data')}}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        edit_id: $("#edit_id").val(),
                        edit_level: $("#edit_level").val(),
                        edit_name: $("#edit_name").val(),
                        edit_account: $("#edit_account").val(),
                        edit_password: $("#edit_password").val(),
                    },
                    success: function (res) {
                        if (res === "success") {
                            window.alert("儲存成功");
                        }
                        $("#edit_level").val('employee');
                        $("#edit_name").val('');
                        $("#edit_account").val('');
                        $("#edit_password").val('');
                        update_data();
                    },
                    error: function (err) {
                        window.alert('儲存失敗：\n' + err['responseJSON']["message"]);
                        console.log(err['responseJSON']["message"]);

                    }
                })
            }

            $("#btn_delete_yes").click(function () {
                delete_user_data($("#delete_user_id").val());
                $("#DeleteUserModal").modal('hide');
            })

            //設定row,編輯按鈕事件
            $("#btn_store_edit_user").click(function () {
                store_edit_user_modal()
                $("#EditUserModal").modal('hide');
            })

            //頁面最上方設定按鈕點擊事件
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

            //頁面最上方搜尋列點擊事件(搜尋功能)
            $("#btn_search").click(function () {
                let search_parameter = $("#search_parameter").val();
                update_data(search_parameter);
            })

            //頁面最上方新增使用者按鈕點擊事件
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
