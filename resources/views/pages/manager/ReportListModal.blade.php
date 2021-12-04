<div id="ReportListModal" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="ReportListModalLabel" style="">目前回報狀態</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>作業員</th>
                        <th>數量</th>
                        <th id="employee">撿巾員</th>
                        <th>完成時間</th>
                    </tr>
                    </thead>
                    <tbody id="tbody_list">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer align-items-end form-group">

            </div>
        </div>
    </div>
</div>
<script>
    //打開modal
    function open_list_modal(id,action) {
        $.ajax({
            url: '{{route('get_resultList')}}',
            method: 'get',
            data: {
                user_id: id,
                action:action
            },
            success: function (res) {
                $("#tbody_list tr").remove();
                console.log(res);

                if (res[0].length > 0) {
                    if(res[1] == "剪巾"){
                        res[0].forEach(function (row) {
                            $("#employee").text("滾邊員");
                            let submit_by = "<td>" + row["submit_by"] + "</td>";
                            let order = "<td>" + row["quantity"] + "</td>";
                            let operator = "<td>" + row["operator"] + "</td>";
                            let time = "<td>" + row["created_at"] + "</td>";
                            $("#tbody_list").append(
                                "<tr>" + submit_by + order + operator + time + "</tr>"
                            );
                        });
                    }
                    else if(res[1] == "撿巾")
                    {
                        $("#employee").hide();
                        res[0].forEach(function (row) {
                            let submit_by = "<td>" + row["submit_by"] + "</td>";
                            let order = "<td>" + row["quantity"] + "</td>";
                            let operator = "<td>" + row["operator"] + "</td>";
                            let time = "<td>" + row["created_at"] + "</td>";
                            $("#tbody_list").append(
                                "<tr>" + submit_by + order + time + "</tr>"
                            );
                        });
                    }
                    else if(res[1] == "滾邊")
                    {
                        $("#employee").hide();
                        res[0].forEach(function (row) {
                            let submit_by = "<td>" + row["submit_by"] + "</td>";
                            let order = "<td>" + row["quantity"] + "</td>";
                            let operator = "<td>" + row["operator"] + "</td>";
                            let time = "<td>" + row["created_at"] + "</td>";
                            $("#tbody_list").append(
                                "<tr>" + submit_by + order + time + "</tr>"
                            );
                        });
                    }
                    else if(res[1] == "折頭")
                    {
                        res[0].forEach(function (row) {
                            let submit_by = "<td>" + row["submit_by"] + "</td>";
                            let order = "<td>" + row["quantity"] + "</td>";
                            let operator = "<td>" + row["operator"] + "</td>";
                            let time = "<td>" + row["created_at"] + "</td>";
                            $("#tbody_list").append(
                                "<tr>" + submit_by + order + operator + time + "</tr>"
                            );
                        });
                    }

                }

            }

        })
    }
</script>

