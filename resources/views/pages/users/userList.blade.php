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

    @include('pages.users.createUserModal')
    @include('pages.users.editUserModal')
    @include('pages.users.deleteUserModal')
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

            if (!navigator.userAgent.toLowerCase().includes("windows")) {
                window.alert('此頁面建議使用電腦觀看，已獲得最佳使用體驗。');
            }

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
                            let row_level = "<td class='user-level'>" + row["level"] + "</td>";
                            let row_name = "<td class='user-name'>" + row["name"] + "</td>";
                            let row_function = "";
                            if (setting_mode === "list") {
                                row_function = `<td><button class='btn btn-outline-secondary btn-work-log' value='${row_id}'>查看</button></td>`;
                            }
                            if (setting_mode === "setting") {
                                row_function =
                                    `<td class=''><button class='btn btn-outline-danger mr-2 btn_remove_user' value='${row_id}' >刪除</button>` +
                                    `<button class='btn btn-outline-info btn_edit_user' value='${row_id}'>修改資訊</button></td>`;
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
                        let user_level = $(this).parent().parent().find(".user-level").text();
                        let is_admin = false;
                        if(user_level === '系統管理員'){
                            is_admin = true;
                        }
                        open_edit_user_modal($(this).attr("value"),is_admin);
                    })

                    //delete user data
                    $(".btn_remove_user").click(function (e) {
                        let user_level = $(this).parent().parent().find(".user-level").text();
                        let delete_user_name = $(this).parent().parent().find(".user-name").text();
                        if(user_level === '系統管理員'){
                            window.alert('系統管理員無法被刪除');
                            return false;
                        }
                        $("#tag_delete_user_id").text(delete_user_name);
                        $("#delete_user_id").val($(this).attr("value"));
                        $("#DeleteUserModal").modal('show');
                    })

                    //"查看"按鈕
                    $(".btn-work-log").click(function () {
                        let employee_id = $(this).val();
                        get_job_log(employee_id);

                    });
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }

        function get_job_log(employee_id) {
            window.location.href = "{{route('get_working_log_page')}}?employee_id="+employee_id;
        }

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
    </script>
@endsection
