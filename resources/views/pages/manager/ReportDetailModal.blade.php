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
@include('pages.manager.ReportListModal')
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
                //剪巾
                if (res[0].length > 0) {
                    c = 1;
                    res[0].forEach(function (row) {
                        let row_item = `<td id="action1" style="vertical-align : middle;text-align:center;" rowspan="${res[0].length}"> ${row["action"]} </td>`;
                        let row_sum_order = `<td style="vertical-align : middle;text-align:center;" rowspan="${res[0].length}" >
                        <a class="btn_list1 text-primary" value='${res[2]}'>${res[2]}${unit}</a> </td>`;
                        let row_employee = "<td>" + row["name"] + "</td>";
                        let row_order = "";
                        if(res[3] == "1")
                        {
                            row_order = `<td>  ${row["quantity"]}${unit} </td>`;
                        }
                        else{
                            row_order = `<td>  ${Math.round((row["quantity"]/12)*100)/100}${unit} </td>`;
                        }
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
                        let row_item = `<td id="action2" style="vertical-align : middle;text-align:center;"
                        rowspan="${res[1].length}"> ${row["action"]} </td>`;
                        let row_sum_order = `<td style="vertical-align : middle;text-align:center;" rowspan="${res[1].length}" >
                        <a class="btn_list2 text-primary" value='${res[2]}'>${res[2]}${unit}</a> </td>`;
                        let row_employee = "<td>" + row["name"] + "</td>";
                        let row_order="";
                        if(res[3] == "1")
                        {
                            row_order = `<td>  ${row["quantity"]}${unit} </td>`;
                        }
                        else{
                            row_order = `<td>  ${Math.round((row["quantity"]/12)*100)/100}${unit} </td>`;
                        }
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
                $('.btn_list1').click(function (){
                    $("#ReportDetailModal").modal('hide');
                    open_list_modal(id,$("#action1").text().replace(" ",""));
                    $("#ReportListModal").modal('show');

                })
                $('.btn_list2').click(function (){
                    $("#ReportDetailModal").modal('hide');
                    open_list_modal(id,$("#action2").text().replace(" ",""));
                    $("#ReportListModal").modal('show');

                })
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

