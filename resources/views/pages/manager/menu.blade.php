@extends('layouts.masters.manager')
@section('content')
    <div class="container">
        <div class="row form-inline form-group">
            <div class="input-group col-sm-5 col-12">
                <input type="text" class="form-control" placeholder="以客戶名稱、貨別、貨號、日期來篩選" aria-label="搜尋派遣單"
                       aria-describedby="basic-addon1" name="search_parameter" id="search_parameter">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button" id="btn_search">搜尋</button>
                </div>
            </div>
            <button type="button" class="btn btn-outline-dark mx-sm-2 mx-1 my-1 col-sm-2 col-4" id="btn_add">新增派遣單
            </button>
            <button type="button" class="btn btn-outline-dark mx-sm-2 mx-1 my-1 col-sm-2 col-4" id="btn_excel">匯出excel
            </button>
            <button type="button" class="btn btn-outline-dark mx-sm-2 mx-1 my-1 col-sm-2 col-3" id="btn_refresh">刷新
            </button>
        </div>
    </div>
    <div class="container text-center" id="ticket_alert">
        <label class="text-center px-auto text-danger"><i class="fas fa-exclamation"></i>表示目前尚有派遣單已超過兩個月未出貨</label>
        <label class="text-center px-auto text-warning"><i class="fas fa-bell"></i>表示目前尚有派遣單超過兩周未進行排程</label>
    </div>
    <div class="container">
        <table class="table rwd-table">
            <thead class="thead-dark">
            <tr>
                <th>客戶名稱</th>
                <th>派遣單編號</th>
                <th>貨號</th>
                <th>訂單數量</th>
                <th>回報</th>
                <th id="th_status">貨別 <i class="fas fa-filter text-white"></i> </th>
                <th>日期</th>
            </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
    </div>
    @include('pages.manager.ReportModal')
    <script>
        let status_list = [];
        let status_index = 0;

        update_data();

        //資料刷新
        function update_data(search_parameter = null) {
            let url = '{{route('get_search_data')}}';
            if (search_parameter !== null) {
                url += '?search_parameter=' + search_parameter;
            }

            $.ajax({
                url: url,
                method: 'GET',
                data: '',
                success: function (res) {
                    // console.log(res)
                    $("#tbody tr").remove();
                    if (res.length > 0) {
                        res.forEach(function (row) {
                            //設定警示功能
                            console.log(row);
                            let row_alert = "";
                            //判斷日期差異，大於兩周且未開始的派遣單將進行警示
                            if(row['diff_days']>14 && row['status'] === '未開始'){
                                row_alert = `<i class="ticket-alert fas fa-bell text-warning"></i>`;
                            }
                            //判斷月份差異，大於兩個月且未結單的派遣單將進行警示
                            if(row['diff_months']>2 && row['status'] === '排程中'){
                                row_alert = `<i class="ticket-alert fas fa-exclamation text-danger"></i>`;
                            }

                            let row_name = `<td>${row_alert}`+ row["employeeName"] + "</td>";
                            let row_id = `<td> <a class="btn_list text-primary" value='${row['id']}'>${row['id']}</a> </td>`;
                            let row_itemId = "<td>" + row["itemId"] + "</td>";
                            let row_order = "<td>" + row["order"] + "條" + "</td>";
                            // let row_result = `<td> <button class="btn btn-outline-dark btn_result" value='${row['id']}'>結果</button> </td>`;
                            let row_result = `<td> <button type="button" class="btn btn-outline-dark btn_result"
                                              id ="btn_result${row['id']}" value='${row['id']}'>結果</button> </td>`;
                            let row_status = "<td class='col_status'>" + row["status"] + "</td>";
                            let row_created_at = "<td>" + row["created_at"] + "</td>";
                            $("tbody").append(
                                "<tr>" + row_name + row_id + row_itemId
                                + row_order + row_result + row_status + row_created_at + "</tr>"
                            );
                        });
                    }
                    if (res.length === 0) {
                        $("#tbody").append(
                            "<tr><td colspan='7' class='text-center'>查無資料</td></tr>"
                        );
                    }
                    //若存在警示訊息則將備註顯示
                    if($('.ticket-alert').length>1){
                        $('#ticket_alert').css('display','show');
                    }else{
                        $('#ticket_alert').css('display','none');
                    }


                    $(".btn_result").click(function () {
                        $("#ReportModal").modal('show');
                        open_result_modal($(this).attr("value"))
                        $("#reportList_unit").val(1)
                    })
                    $(".btn_list").click(function () {
                        window.location.href = "/manager/menu/list/" + $(this).attr("value");
                    })
                    get_status_list();
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }

        //取得貨別列表
        function get_status_list() {
            let cols = [];

            //先抓出所有的col
            $("#tbody > tr").children(".col_status").each(function (index, val) {
                let col = $(this).text();
                cols.push(col);
            });

            //過濾掉重複的數值，取得貨別列表
            cols = cols.filter(function (element, index, arr) {
                return arr.indexOf(element) === index;
            });

            status_list = cols;

            return cols;
        }

        //篩選貨別
        function filter_status() {
            status_index += 1;
            let status_list_length = status_list.length;
            let filter_str = status_list[status_index % status_list_length];
            console.log(filter_str);
            //先抓出所有的col
            $("#tbody tr").hide()
                .filter(`:contains('${filter_str}')`).show();
        }

        //頁面最上方搜尋列點擊事件(搜尋功能)
        $("#btn_search").click(function () {
            let search_parameter = $("#search_parameter").val();
            update_data(search_parameter);
        })
        //匯出excel按鈕
        $("#btn_excel").click(function () {
            window.location.href = "{{route('menu_export')}}";
        })
        //刷新按鈕
        $("#btn_refresh").click(function () {
            update_data("");
        })
        //新增派遣單按鈕
        $("#btn_add").click(function () {
            let url = "{{Route('get_addSheet')}}";
            window.location.href = url;
        })

        //新增貨別篩選
        $("#th_status").click(function () {
            console.log('th_status');
            filter_status();
        })
    </script>


@endsection
