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
                <button class="btn btn-primary" id="btn-list-close">返回</button>
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
                    if(res[2] == "剪巾"){
                        $("#employee").hide();
                        for(let i = 0; i <res[0].length; i++){
                            let submit_by = "<td>" + res[1][i]["name"] + "</td>";
                            let order = "<td>" + res[0][i]["quantity"] + "</td>";
                            let time = "<td>" + res[0][i]["created_at"] + "</td>";
                            $("#tbody_list").append(
                                "<tr>" + submit_by + order  + time + "</tr>"
                            );
                        }

                    }
                    else if(res[2] == "撿巾")
                    {
                        $("#employee").show();
                        $("#employee").text("折頭員");
                        for(let i = 0; i <res[0].length; i++){
                            let submit_by = "<td>" + res[1][i]["name"] + "</td>";
                            let order = "<td>" + res[0][i]["quantity"] + "</td>";
                            let operator = "<td>" + res[0][i]["name"] + "</td>";
                            let time = "<td>" + res[0][i]["created_at"] + "</td>";
                            $("#tbody_list").append(
                                "<tr>" + operator + order + submit_by + time + "</tr>"
                            );
                        }
                    }
                    else if(res[2] == "滾邊")
                    {
                        $("#employee").show();
                        $("#employee").text("剪巾員");
                        for(let i = 0; i <res[0].length; i++){
                            let submit_by = "<td>" + res[1][i]["name"] + "</td>";
                            let order = "<td>" + res[0][i]["quantity"] + "</td>";
                            let operator = "<td>" + res[0][i]["name"] + "</td>";
                            let time = "<td>" + res[0][i]["created_at"] + "</td>";
                            $("#tbody_list").append(
                                "<tr>" + operator + order + submit_by + time + "</tr>"
                            );
                        }
                        // res[0].forEach(function (row) {
                        //     $("#employee").text("剪巾員");
                        //     let submit_by = "<td>" + row["submit_by"] + "</td>";
                        //     let order = "<td>" + row["quantity"] + "</td>";
                        //     let operator = "<td>" + row["name"] + "</td>";
                        //     let time = "<td>" + row["created_at"] + "</td>";
                        //     $("#tbody_list").append(
                        //         "<tr>" + operator + order + submit_by +time + "</tr>"
                        //     );
                        // });
                    }
                    else if(res[2] == "折頭")
                    {
                        $("#employee").hide();
                        for(let i = 0; i <res[0].length; i++){
                            let submit_by = "<td>" + res[1][i]["name"] + "</td>";
                            let order = "<td>" + res[0][i]["quantity"] + "</td>";
                            let time = "<td>" + res[0][i]["created_at"] + "</td>";
                            $("#tbody_list").append(
                                "<tr>" + submit_by + order  + time + "</tr>"
                            );
                        }
                    }

                }
                $("#btn-list-close").click(function () {
                    $("#ReportListModal").modal('hide');
                    $("#ReportDetailModal").modal('show');
                });
            }

        })
    }
</script>

