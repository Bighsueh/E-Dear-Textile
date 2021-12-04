{{--    <div class="modal fade" id="TaskReportModal" tabindex="-1" role="dialog" aria-labelledby="TaskReportModalTitle"--}}
{{--         aria-hidden="true">--}}
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="TaskReportModalLongTitle">回報任務</h5>
            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row form-group">
                    <label for="report_ticket_id" class="col-sm-3 col-5 ">派遣單編號</label>
                    <input class="form-control col-sm-8 col-7" id="report_ticket_id" type="text" readonly/>
                </div>
                <div class="row form-group">
                    <label for="report_customer_name" class="col-sm-3 col-5 ">客戶名稱</label>
                    <input class="form-control col-sm-8 col-7" id="report_customer_name" type="text" readonly/>
                </div>
                <div class="row form-group">
                    <label for="report_color_cable" class="col-sm-3 col-5 ">色線編號</label>
                    <input class="form-control col-sm-8 col-7" id="report_color_cable" type="text" readonly/>
                </div>
                <div class="row form-group">
                    <label for="report_wash_tag" class="col-sm-3 col-5 ">洗標</label>
                    <input class="form-control col-sm-8 col-7" id="report_wash_tag" type="text" readonly/>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-12 col-12">滾邊員完成數量</label>
                    <table id="report_piping_list">
                        <tr class="col-sm-12 col-12 piping-row row">
                            <td class="piping-people col-sm-4 col-12 mr-auto mb-2 form-group">
                                <select class="form-control ">
                                    <option value="ppp" selected>滾邊員</option>
                                    <option value="yes">耶斯</option>
                                </select>
                            </td>
                            <td class="piping-number col-sm-4 col-6 mx-auto mb-2 form-group">
                                <input class="form-control " id="report_piping_complete_num"
                                       placeholder="請輸入數量" type="text"/>
                            </td>
                            <td class="piping-unit col-sm-4 col-6 ml-auto mb-2 form-group">
                                <select class="form-control">
                                    <option value="" selected>單位</option>
                                    <option value="one">條</option>
                                    <option value="dozen">打</option>
                                </select>
                            </td>

                        </tr>

                    </table>
                    <div class="col-sm-12 col-12 row">
                        <button class="btn col-sm-12 col-12 text-center btn-outline-info ml-autos"
                                id="btn_add_pipings">+
                        </button>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-12 col-12">剪巾員完成數量</label>
                    <div class="col-sm-12 col-12 row">
                        <input id="report-operator-name" class="form-control col-sm-11 col-11 mx-auto mb-2"
                               value="剪巾name" readonly/>
                    </div>
                    <div class="col-sm-12 col-12 row">
                        <input class="form-control col-sm-7 col-7 mx-auto" id="report_operator_num"
                               placeholder="請輸入數量" type="text"/>
                        <select id="report-operator-unit" class="form-control col-sm-3 col-3 mx-auto">
                            <option value="one" selected>條</option>
                            <option value="dozen">打</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row form-group mx-auto">
                    <label for="report_time" class="col-sm-4 col-4">最後回報時間</label>
                    <input class="form-control col-sm-7 col-7" id="report_time" type="text" readonly/>
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-success" id="btn_store_report">送出回報</button>
        </div>
    </div>
</div>
{{--    </div>--}}
<script>

    //滾邊員增加
    let create_piping_row = $("#report_piping_list").html();

    //增加滾邊員輸入列
    $("#btn_add_pipings").click(function () {
        temp_piping_row = $("#report_piping_list").html();
        $("#report_piping_list").html(temp_piping_row + create_piping_row);
    });


    //打開report_modal(傳入ticket_id)
    function open_report_modal(ticket_id) {
        {{--$.ajax({--}}
        {{--    url: '{{route('')}}',--}}
        {{--    method: 'get',--}}
        {{--    data: {--}}

        {{--    },--}}
        {{--    success: function (res) {--}}

        {{--        $("#TaskReportModal").modal('show');--}}
        {{--    },--}}
        {{--    error: function (err) {--}}

        {{--    },--}}
        {{--})--}}
        $("#TaskReportModal").modal('show');
    }

    //儲存回報結果
    function store_report_data() {
        let url = "";

        let ticket_id = document.getElementById('report_ticket_id').value;
        let piping_list = get_piping_list_array();
        let operator_name = document.getElementById('report-operator-name').value;
        let operator_number = document.getElementById('report_operator_num').value;
        let operator_unit = document.getElementById('report-operator-unit').value;
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                ticket_id: ticket_id,
                piping_list: piping_list,
                operator_name: operator_name,
                operator_number: operator_number,
                operator_unit: operator_unit
            },
            success: function (res) {
                console.log(res);
            },
            error: function (err) {
                console.log(err);
            }
        })
    }

    //取得頁面中滾邊員回報資訊
    function get_piping_list_array() {
        let piping_people;
        let piping_number;
        let piping_unit;
        let piping_list = [];
        container = $("#report_piping_list tr").each(function (index, tr) {
            // console.log($(this).children().find());
            //滾邊員
            piping_people = $(this).find(".piping-people > select > option:selected").val();
            //數量
            piping_number = $(this).find(".piping-number > input").val();
            //單位
            piping_unit = $(this).find(".piping-unit > select > option:selected").val();

            //將資料push進array:piping_list裡面
            piping_list.push([piping_people, piping_number, piping_unit])
        });
        return piping_list;
    }


</script>



