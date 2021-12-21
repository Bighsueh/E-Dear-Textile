@extends('layouts.masters.manager')
@section('content')

    <div class="container">
        <div class="row form-inline form-group">
            <div class="input-group col-sm-8 col-8">
                <input type="text" class="form-control" placeholder="搜尋貨單關鍵字" aria-label=""
                       aria-describedby="basic-addon1" name="search_parameter" id="search_parameter">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button" id="btn_search">搜尋</button>
                </div>
            </div>
            <div class="col-sm-4 col-4 row">
                <div class="form-control col col-sm text-center">
                    員工：{{$data['employee_name']}}
                </div>
                <button type="button" class="btn btn-outline-secondary mx-1 col col-sm text-center"
                        id="btn_export_excel">
                    匯出報表
                </button>
            </div>
            <input type="hidden" id="employee_id" value="{{$data["employee_id"]}}"/>

        </div>

    </div>
    <div style="" class="container-fluid px-5">
        <table class="table">
            <thead class="thead-dark">
            <tr class="">
                <th class="col-sm-1">#</th>
                <th class="col-sm-1">貨別</th>
                <th class="col-sm-1">工作類別</th>
                <th class="col-sm-1">貨單編號</th>
                <th class="col-sm-1">貨單日期</th>
                <th class="col-sm-1">客戶簡稱</th>
                <th class="col-sm-1">貨品編號</th>
                <th class="col-sm-1">品名規格</th>
                <th class="col-sm-1">數量</th>
                <th class="col-sm-1">單位</th>
                <th class="col-sm-1">單價</th>
                <th class="col-sm-1">金額</th>
            </tr>
            </thead>
            <tbody id="tbody">
            <tr>

            </tr>
            </tbody>

        </table>

    </div>
    <script>
        if (!navigator.userAgent.toLowerCase().includes("windows")) {
            window.alert('此頁面建議使用電腦觀看，已獲得最佳使用體驗。');
        }

        //excel輸出功能
        $("#btn_export_excel").click(function () {
            let employee_id = "{{$data["employee_id"]}}";
            let employee_name = "{{$data['employee_name']}}";
            let search_parameter = document.getElementById("search_parameter").value;
            window.location.href = "{{route('working_job_export_excel')}}" + "?employee_id=" + employee_id + "&search_parameter=" + search_parameter +"&employee_name=" +employee_name;
        })

        //頁面最上方搜尋列點擊事件(搜尋功能)
        $("#btn_search").click(function () {
            let search_parameter = $("#search_parameter").val();
            update_data(search_parameter);
        })

        update_data();

        //資料刷新
        function update_data(search_parameter = null) {
            let url = '{{route('get_working_log_data')}}';

            if (!navigator.userAgent.toLowerCase().includes("windows")) {
                window.alert('此頁面建議使用電腦觀看，已獲得最佳使用體驗。');
            }

            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    user_id: $("#employee_id").val(),
                    search_parameter : search_parameter,
                },
                success: function (res) {
                    console.log(res)
                    let thread = 1;
                    $("#tbody tr").remove();
                    if (res.length > 0) {
                        res.forEach(function (row) {
                            if (row["unit"] === 'one') {
                                row["unit"] = '條';
                            }
                            if (row["unit"] === 'dozen') {
                                row["unit"] = '打';
                            }

                            let row_thread = "<td>" + (thread++) + "</td>";
                            let row_action = "<td>" + row['action'] + "</td>";
                            let row_status = "<td>" + row["status"] + "</td>";
                            let row_ticket_id = "<td>" + row["ticket_id"] + "</td>";
                            let row_updated_at = "<td>" + row["updated_at"] + "</td>";
                            let row_customer_name = "<td>" + row["employeeName"] + "</td>";
                            let row_item_id = "<td>" + row["itemId"] + "</td>";
                            let row_specification = "<td>" + row["rollFunc"] + row["item"] + "</td>";
                            let row_quantity = "<td>" + row["quantity"] + "</td>";
                            let row_unit = "<td>" + row["unit"] + "</td>";
                            let row_unit_price = "<td>" + "-" + "</td>";
                            let row_total_price = "<td>" + "-" + "</td>";
                            $("#tbody").append(
                                "<tr>" + row_thread + row_status + row_action + row_ticket_id + row_updated_at +
                                row_customer_name + row_item_id + row_specification + row_quantity + row_unit +
                                row_unit_price + row_total_price + "</tr>"
                            );
                        });
                    }
                    if (res.length === 0) {
                        $("tbody").append(
                            "<tr class='row'><td colspan='11' class='text-center col-sm-12 col-12'>查無資料</td></tr>"
                        );
                    }

                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
