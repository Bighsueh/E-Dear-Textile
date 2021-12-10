@extends('layouts.masters.customer')

@section('content')
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
    //更新資料表狀態
    function set_list_view(res){
        res.forEach(function (val, index) {
            console.log(val);
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
        let url = "{{route('get_tickets_data')}}";
        $.ajax({
            url: url,
            method: "GET",
            data: {
                search_parameter: search_parameter,
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
