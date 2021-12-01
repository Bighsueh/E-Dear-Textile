@section('content')
    <div class="modal fade" id="TaskReportModal" tabindex="-1" role="dialog" aria-labelledby="TaskReportModalTitle"
         aria-hidden="true">
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
                        <div id="report_piping_list" class="col-sm-12 col-12 row">
                            <select class="form-control col-sm-3 col-12 mr-auto mb-2">
                                <option value="" selected>滾邊員</option>
                                <option value="">耶斯</option>
                            </select>
                            <input class="form-control col-sm-4 col-6 mx-auto mb-2" id="report_piping_complete_num"
                                   placeholder="請輸入數量" type="text"/>
                            <select class="form-control col-sm-3 col-6 ml-auto mb-2">
                                <option value="" selected>單位</option>
                                <option value="one">條</option>
                                <option value="dozen">打</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-12 row">
                            <button class="btn col-sm-12 col-12 text-center btn-outline-info ml-autos"
                                    id="btn_add_pipings">+
                            </button>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-12 col-12">剪巾員完成數量</label>
                        <div class="col-sm-12 col-12 row">
                            <input class="form-control col-sm-11 col-11 mx-auto mb-2" value="剪巾name" readonly/>
                        </div>
                        <div class="col-sm-12 col-12 row">
                            <input class="form-control col-sm-7 col-7 mx-auto" id="report_piping_complete_num"
                                   placeholder="請輸入數量" type="text"/>
                            <select class="form-control col-sm-3 col-3 mx-auto">
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
    </div>
    <script>
        //滾邊員增加
        create_piping_row = $("#report_piping_list").html();

        //增加滾邊員輸入列
        $("#btn_add_pipings").click(function () {
            temp_piping_row = $("#report_piping_list").html();
            $("#report_piping_list").html(temp_piping_row + create_piping_row);
        });

        //打開report_modal(傳入ticket_id)
    {{--    function open_report_modal(ticket_id) {--}}
    {{--        $.ajax({--}}
    {{--            url: '{{route('')}}',--}}
    {{--            method: 'get',--}}
    {{--            data: {--}}

    {{--            },--}}
    {{--            success: function (res) {--}}

    {{--                $("#TaskReportModal").modal('show');--}}
    {{--            },--}}
    {{--            error: function (err) {--}}

    {{--            },--}}
    {{--        })--}}
    {{--    }--}}
    </script>
@endsection
