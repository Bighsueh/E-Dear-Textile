{{--<div class="modal fade" id="HeadReportModal" tabindex="-1" role="dialog" aria-labelledby="HeadReportModalTitle"--}}
{{--     aria-hidden="true">--}}
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="HeadReportModalLongTitle">折頭-回報任務</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row form-group">
                        <label for="head_ticket_id" class="col-sm-3 col-5 ">派遣單編號</label>
                        <input class="form-control col-sm-8 col-7" id="head_ticket_id" type="text" readonly/>
                    </div>
                    <div class="row form-group">
                        <label for="head_customer_name" class="col-sm-3 col-5 ">客戶名稱</label>
                        <input class="form-control col-sm-8 col-7" id="head_customer_name" type="text" readonly/>
                    </div>
                    <div class="row form-group">
                        <label for="head_color_cable" class="col-sm-3 col-5 ">色線編號</label>
                        <input class="form-control col-sm-8 col-7" id="head_color_cable" type="text" readonly/>
                    </div>
                    <div class="row form-group">
                        <label for="head_wash_tag" class="col-sm-3 col-5 ">洗標</label>
                        <input class="form-control col-sm-8 col-7" id="head_wash_tag" type="text" readonly/>
                    </div>
                    <br>
                    <div class="row form-group">
                        <label class="col-sm-12 col-12">折頭員完成數量</label>
                        <div class="col-sm-12 col-12 row">
                            <input id="report-operator-name" class="form-control col-sm-11 col-11 mx-auto mb-2"
                                   value="折頭name" readonly/>
                        </div>
                        <div class="col-sm-12 col-12 row">
                            <input class="form-control col-sm-7 col-7 mx-auto" id="head_operator_num"
                                   placeholder="請輸入數量" type="text"/>
                            <select id="report-operator-unit" class="form-control col-sm-3 col-3 mx-auto">
                                <option value="one" selected>條</option>
                                <option value="dozen">打</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-12">撿巾員完成數量</label>
                        <table id="head_report_list">
                            <tr class="col-sm-12 col-12 pick-row row">
                                <td class="pick-people col-sm-4 col-12 mr-auto mb-2 form-group">
                                    <select class="form-control pick-select">
                                        <option value="">撿巾員</option>
                                    </select>
                                </td>
                                <td class="pick-number col-sm-4 col-6 mx-auto mb-2 form-group">
                                    <input class="form-control " id="head_pick_complete_num"
                                           placeholder="數量" type="text"/>
                                </td>
                                <td class="pick-unit col-sm-4 col-6 ml-auto mb-2 form-group">
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
                                    id="btn_add_picks">+
                            </button>
                        </div>
                    </div>

                    <br>
                    <div class="row form-group mx-auto">
                        <label for="head_time" class="col-sm-12 col-12">最後回報時間</label>
                        <input class="form-control col-sm-12 col-12" id="head_time" type="text" readonly/>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" id="btn_store_report">送出回報</button>
            </div>
        </div>
    </div>
{{--</div>--}}
<script>



</script>



