<div id="ReportDetailModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="ReportDetailModalLabel" style="">目前回報狀態 </h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th class="text-center">項目</th>
                        <th class="text-center">總數量</th>
                        <th>作業員</th>
                        <th>數量</th>
                    </tr>
                    </thead>
                    <tbody id="tbody_detail">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer align-items-end form-group">
            </div>
        </div>
    </div>
</div>
<script>
    function open_detail_modal(num,id,action,unit) {
        $.ajax({
            url: '{{route('get_resultDetail')}}',
            method: 'get',
            data: {
                user_id: id,
                num:num,
                action:action,
                unit:unit
            },
            success: function (res) {
                console.log(res)
                unit = "";
                $("#tbody_detail tr").remove();
                if(res[3] == "1"){
                    unit ="條";
                }else{
                    unit ="打";
                }
                let c;
                if (res[0].length > 0) {
                    c = 1;
                    res[0].forEach(function (row) {
                        let row_item = `<td style="vertical-align : middle;text-align:center;" rowspan="${res[0].length}"> ${row["action"]} </td>`;
                        let row_sum_order = `<td style="vertical-align : middle;text-align:center;" rowspan="${res[0].length}" >
                        <a class="btn_list text-primary" value='${res[2]}'>${res[2]}${unit}</a> </td>`;
                        let row_employee = "<td>" + row["operator"] + "</td>";
                        let row_order = "<td>" + row["quantity"] + "</td>";
                        if (c == 1) {
                            $("#tbody_detail").append(
                                "<tr>" + row_item + row_sum_order+ row_employee+ row_order + "</tr>"
                            );
                        } else {
                            $("#tbody_detail").append(
                                "<tr>" + row_employee + row_order + "</tr>"
                            );
                        }
                        c+=1;
                    });
                }
                if (res[1].length > 0) {
                    c = 1;
                    res[1].forEach(function (row) {
                        let row_item = `<td style="vertical-align : middle;text-align:center;"
                        rowspan="${res[1].length}"> ${row["action"]} </td>`;
                        let row_sum_order = `<td style="vertical-align : middle;text-align:center;" rowspan="${res[1].length}" >
                        <a class="btn_list text-primary" value='${res[2]}'>${res[2]}${unit}</a> </td>`;
                        let row_employee = "<td>" + row["operator"] + "</td>";
                        let row_order = "<td>" + row["quantity"] + "</td>";
                        if (c == 1) {
                            $("#tbody_detail").append(
                                "<tr>" + row_item + row_sum_order+ row_employee+ row_order + "</tr>"
                            );
                        } else {
                            $("#tbody_detail").append(
                                "<tr>" + row_employee + row_order + "</tr>"
                            );
                        }
                        c+=1;
                    });
                }

            }

        })
    }
    function close_modal(){
        $(".modal").modal('hide');
    }
    $(".close-modal").click(function () {
        close_modal();
    })
</script>

