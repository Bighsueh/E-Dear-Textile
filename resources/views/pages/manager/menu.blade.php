@extends('layouts.masters.manager')
@section('content')
    <div class="container">
        <div class="row form-inline form-group">
            <div class="input-group col-sm-8 col-8">
                <input type="text" class="form-control" placeholder="搜尋派遣單關鍵字" aria-label=""
                       aria-describedby="basic-addon1" name="search_parameter" id="search_parameter">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button" id="btn_search">搜尋</button>
                </div>
            </div>

        </div>

    </div>
    <div style="display: flex" class="container">

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>客戶名稱</th>
                <th>派遣單編號</th>
                <th>貨號</th>
                <th>訂單數量</th>
                <th>回報</th>
                <th>貨別</th>
                <th>日期</th>
            </tr>
            </thead>
            <tbody id="tbody">
            </tbody>

        </table>

    </div>
    <script>
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
                    console.log(res)
                    $("#tbody tr").remove();
                    if (res.length > 0) {
                        res.forEach(function (row) {
                            let row_name = "<td>" + row["employeeName"] + "</td>";
                            let row_id = "<td>" + row['id'] + "</td>";
                            let row_itemId = "<td>" + row["itemId"] + "</td>";
                            let row_order = "<td>" + row["order"] + "</td>";
                            let row_result = `<td> <button class="btn btn-outline-dark btn_result" value='${row['id']}'>結果</button> </td>`;
                            let row_status = "<td>" + row["status"] + "</td>";
                            let row_created_at = "<td>" + row["created_at"] + "</td>";
                            $("tbody").append(
                                "<tr>" + row_name + row_id + row_itemId
                                        + row_order + row_result + row_status + row_created_at + "</tr>"
                            );
                        });
                    }
                    if (res.length === 0) {
                        $("tbody").append(
                            "<tr><td colspan='7' class='text-center'>查無資料</td></tr>"
                        );
                    }
                    $(".btn_result").click(function (){
                        window.location.href="/manager/menu/result/"+$(this).attr("value");
                    })

                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
        //頁面最上方搜尋列點擊事件(搜尋功能)
        $("#btn_search").click(function () {
            let search_parameter = $("#search_parameter").val();
            update_data(search_parameter);
        })

    </script>


@endsection
