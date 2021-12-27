<div id="TicketSettingModal" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title col-sm-4" id="TicketSettingModalLabel" style="">派遣單資料設定</h5>
                <div class="col-sm-6 row justify-content-end mx-2">
                    <button type="button" id="btn_ticket_setting_download_excel"
                            class="btn btn-outline-success ml-1">
                        下載設定檔
                    </button>
                    <button type="button" id="btn_ticket_setting_upload_excel" class="btn btn-outline-info ml-1">
                        上傳更新檔
                    </button>

                </div>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            客戶名稱
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_customer_name">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            貨號
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_item_no">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            洗標
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_wash_tag">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            品項
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_item">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            漂染廠
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_blenching_and_dyeing_factory">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            顏色
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_color">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            色線編號
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_color_thread">
                            <option>1</option>
                        </select>
                    </div>

                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            滾邊方式
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_piping_method">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            備註
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_remark">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            狀態
                        </label>
                        <select class="col-sm-8 mx-auto form-control ticket-setting-select"
                                id="select_ticket_setting_ticket_status">
                            <option>1</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="modal-footer align-items-end form-group">
                <button class="btn btn-outline-secondary" id="btn-list-close">返回</button>
            </div>
        </div>
    </div>
</div>
{{--上傳檔案--}}
<div class="modal fade" id="TicketSettingUploadModal" tabindex="-1" role="dialog"
     aria-labelledby="TicketSettingUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TicketSettingUploadModalLabel">上傳更新檔</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-group">
                        <form id="form_ticket_setting_upload">
                            <label for="btn_ticket_setting_upload_input_file">點選下方上傳excel檔案</label>
                            <input type="file" class="form-control-file" id="btn_ticket_setting_upload_input_file"
                                   name="upload_file" accept=".xlsx">
                        </form>
                    </div>
                    <div class="colsm-2">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">取消上傳</button>
                <button type="button" id="btn_ticket_setting_upload" class="btn btn-outline-success">送出上傳結果</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("#navbar_ticket_setting").click(function () {
        update_ticket_setting_modal();
        $("#TicketSettingModal").modal('show');
    })
    $('#btn_ticket_setting_download_excel').click(function () {
        url = "{{route('export_default_ticket_content')}}";

        window.location.href = url;
    })
    $('#btn_ticket_setting_upload_excel').click(function () {
        $('#TicketSettingUploadModal').modal('show');

    })
    $('#btn_ticket_setting_upload').click(function () {
        //取得input_ticket_setting_upload
        let upload_file = $('#btn_ticket_setting_upload_input_file')[0].files;
        //取得url
        let url = "{{route('import_default_ticket_content')}}";
        let csrf_token = "{{csrf_token()}}";

        //未選取檔案
        if (upload_file.length <= 0) {
            window.alert('請先上傳檔案');
        }
        //已選取檔案
        if (upload_file.length > 0) {
            //先建立formData
            let form_data = new FormData()
            form_data.append('upload_file', upload_file[0])

            $.ajax({
                url: url + "?_token=" + csrf_token,
                method: 'post',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    console.log('upload success');
                    update_ticket_setting_modal();
                    $('#TicketSettingUploadModal').modal('hide');
                },
                error: function (res) {
                    window.alert('連線失敗!!');
                    console.log('connect error');
                    console.log(res);

                    $('#TicketSettingUploadModal').modal('hide');
                }
            })
        }
    })

    //更新modal資料
    function update_ticket_setting_modal() {
        let url = "{{route('get_default_ticket_setting_data')}}";
        $.ajax({
            url: url,
            method: 'get',
            error: function (res) {
                console.log('error');
            },
            success: function (res) {
                //先清空所有的select
                $('.ticket-setting-select option').remove();

                //將資料匯入select中
                $.each(res, function (index, row) {
                    $.each(row, function (index, value) {
                        let select_value = undefined; //option內容
                        let select_name = ""; //要選擇的select name
                        //顧客名稱
                        if (value['customer_name']) {
                            select_name = 'customer_name';
                            select_value = value['customer_name'];
                        };
                        //貨號
                        if (value['item_no']) {
                            select_name = 'item_no';
                            select_value = value['item_no'];
                        };
                        //顏色
                        if (value['color']) {
                            select_name = 'color';
                            select_value = value['color'];
                        };
                        //洗標
                        if (value['wash_tag']) {
                            select_name = 'wash_tag';
                            select_value = value['wash_tag'];
                        };
                        //品項
                        if (value['item']) {
                            select_name = 'item';
                            select_value = value['item'];
                        };
                        //漂染廠
                        if (value['blenching_and_dyeing_factory']) {
                            select_name = 'blenching_and_dyeing_factory';
                            select_value = value['blenching_and_dyeing_factory'];
                        };
                        //色線編號
                        if (value['color_thread']) {
                            select_name = 'color_thread';
                            select_value = value['color_thread'];
                        };
                        //滾邊方式
                        if (value['piping_method']) {
                            select_name = 'piping_method';
                            select_value = value['piping_method'];
                        };
                        //備註
                        if (value['remark']) {
                            select_name = 'remark';
                            select_value = value['remark'];
                        };
                        //訂單狀態
                        if (value['ticket_status']) {
                            select_name = 'ticket_status';
                            select_value = value['ticket_status'];
                        };

                        //將options寫入select
                        if (select_value) {
                            select_name = "#select_ticket_setting_" + select_name;
                            $(`${select_name}`).append($('<option>', {
                                text: select_value,
                            }));
                        }
                    });
                })
            }

        })
    }
</script>
