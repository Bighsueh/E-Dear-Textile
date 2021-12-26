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
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            貨號
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            洗標
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            品項
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            漂染廠
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            色線
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            色線編號
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            洗標
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            滾邊方式
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            備註
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label class="col-sm-2 mx-auto text-right">
                            狀態
                        </label>
                        <select class="col-sm-8 mx-auto form-control">
                            <option>1</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="modal-footer align-items-end form-group">
                <button class="btn btn-primary" id="btn-list-close">返回</button>
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
    $('#btn_ticket_setting_download_excel').click(function () {
        window.alert('這邊要下載');
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
                    $('#TicketSettingUploadModal').modal('hide');
                },
                error: function (res) {
                    console.log('connect error');
                    window.alert('連線失敗：' + res);
                    $('#TicketSettingUploadModal').modal('hide');
                }
            })
        }

    })
</script>
