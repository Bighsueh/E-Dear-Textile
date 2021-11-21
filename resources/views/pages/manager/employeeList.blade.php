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
                                    `<buttun class='btn btn-outline-info btn_edit_user'>修改資訊</buttun></td>`;
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


                },
                error: function (err) {
                    console.log(err);
                }
            })

        }

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


    </script>


@endsection
