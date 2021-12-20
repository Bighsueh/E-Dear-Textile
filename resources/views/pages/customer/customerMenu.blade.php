@extends('layouts.masters.customer')

@section('content')
    <div class="container ">
        <div class="row form-inline form-group">
            <div class="input-group col-sm-8 col-8">
                <input type="text" class="form-control" placeholder="以派遣單編號、貨號" aria-label=""
                       aria-describedby="basic-addon1" name="search_parameter" id="search_parameter">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button" id="btn_search">搜尋</button>
                </div>
            </div>
            <div class="col-sm-4 col-4 row">
                <button type="button" class="btn btn-outline-secondary mx-1 col col-sm text-center" id="btn_refresh">
                    刷新
                </button>
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
                <th>目前狀態</th>
            </tr>
            </thead>
            <tbody id="tbody" class="tbody">

            </tbody>
        </table>
    </div>
@include('pages.customer.ConfirmIdentityModal')
<script>
    $("#btn_search").click(function () {
        let search_parameter = $("#search_parameter").val();
        update_tickets_list(search_parameter);
    })

    $("#btn_refresh").click(function () {
        let search_parameter = $("#search_parameter").val();
        update_tickets_list(search_parameter);
    })


    //更新資料表狀態
    function set_list_view(res){
        console.log('123');
        $('#tbody tr').remove();
        res.forEach(function (val, index) {
            let row_customer_name = '<td>' + val['employeeName'] +'</td>';
            let row_ticket_id = '<td>' + val['id'] + '</td>';
            let row_item_id = '<td>' + val['itemId'] +'</td>';
            let row_order = '<td>' + val['order'] +'</td>';
            let row_status = '<td>' + val['status'] + '</td>';
            let row = '<tr>' + row_customer_name + row_ticket_id + row_item_id + row_order + row_status + '</tr>';

            $("#tbody").append(row);
        });

    }

    //取得派遣單資料
    function update_tickets_list(search_parameter = null) {

        let search_content = search_parameter;
        let url = "{{route('get_tickets_data')}}";
        $.ajax({
            url: url ,
            method: "GET",
            data:{
                'search_parameter' : search_content
            },
            success: function (res) {
                set_list_view(res);
                close_confirm_modal();
            },
            error: function (res) {
                console.log(res);
            }
        })
    }
</script>


@endsection
