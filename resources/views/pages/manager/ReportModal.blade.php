<div id="ReportModal" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="ReportModalLabel" style="">目前回報狀態</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container p-2">
                    <div class="row form-group">
                        <label for="reportList_name" class="col-sm-3 col-5 ">客戶名稱</label>
                        <input class="form-control col-sm-8 col-7" id="reportList_name" type="text" value="" readonly/>
                    </div>
                    <div class="row form-group">
                        <label for="reportList_ticket_id" class="col-sm-3 col-5 ">派遣單編號</label>
                        <input class="form-control col-sm-8 col-7" id="reportList_ticket_id" type="text" value="" readonly/>
                    </div>
                    <div class="row form-group">
                        <label for="reportList_itemId" class="col-sm-3 col-5 ">貨號</label>
                        <input class="form-control col-sm-8 col-7" id="reportList_itemId" type="text" value="" readonly/>
                    </div>
                    <div class="row form-group">
                        <label for="reportList_colorLine" class="col-sm-3 col-5 ">色線</label>
                        <input class="form-control col-sm-8 col-7" id="reportList_colorLine" type="text" value="" readonly/>
                    </div>
                    <div class="row form-group">
                        <label for="reportList_wash" class="col-sm-3 col-5 ">洗標</label>
                        <input class="form-control col-sm-8 col-7" id="reportList_wash" type="text" value="" readonly/>
                    </div>
                    <div class="row form-group">
                        <label for="reportList_order" class="col-sm-3 col-5 ">訂單數量</label>
                        <input class="form-control col-sm-8 col-7" id="reportList_order" type="text" value="" readonly/>
                    </div>
                    <div class="row form-group">
                        <label for="reportList_unit" class="col-sm-3 col-5 ">顯示單位</label>
                        <select class="form-select" id="reportList_unit"aria-label="單位選擇">
                            <option selected value="1">條</option>
                            <option value="12">打</option>
                        </select>
                    </div>
                    <div class="row form-group">
                        <label for="reportList_cut" class="col-sm-3 col-5 ">剪巾 回報</label>
                        <a class="text-primary" id="reportList_cut" data-toggle="modal" data-target="#ReportModal" value=""></a>
                    </div>
                    <div class="row form-group">
                        <label for="reportList_foldHead" class="col-sm-3 col-5 ">折頭 回報</label>
                        <a class="text-primary" id="reportList_foldHead" value=""></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer align-items-end form-group">

            </div>
        </div>
    </div>
</div>
@include('pages.manager.ReportDetailModal')
<script>
    //打開modal
    function open_result_modal(id) {
        $.ajax({
            url: '{{route('get_result')}}',
            method: 'get',
            data: {
                user_id: id,
            },
            success: function (res) {
                $("#reportList_name").val(res[0][0]["employeeName"]);
                $("#reportList_ticket_id").val(res[0][0]["id"]);
                $("#reportList_itemId").val(res[0][0]["itemId"]);
                $("#reportList_colorLine").val(res[0][0]["colorId"]+"-"+res[0][0]["colorId2"]);
                $("#reportList_wash").val(res[0][0]["wash"]);
                $("#reportList_order").val(res[0][0]["order"]);
                if(res[1] == 0) {
                    $("#reportList_cut").text("尚未回報");
                }
                else{
                    $("#reportList_cut").text(res[1]+"條");
                    $("#reportList_cut").val(res[1]);
                }

                if(res[2] == 0) {
                    $("#reportList_foldHead").text("尚未回報");
                }
                else{
                    $("#reportList_foldHead").text(res[2]+"條");
                    $("#reportList_foldHead").val(res[2]);
                }
            }

        })
    }
    //單位轉換
    $('#reportList_unit').change(function (){
        if($('#reportList_unit').val() == 12){
            let cut_num = Math.round(($("#reportList_cut").val()/12)*100)/100;
            let foldHead_num = Math.round(($("#reportList_foldHead").val()/12)*100)/100
            if(cut_num !== 0 ){
                $("#reportList_cut").text(cut_num+"打");
                $("#reportList_cut").val(cut_num);
            }
            if(foldHead_num !== 0){
                $("#reportList_foldHead").text(foldHead_num +"打");
                $("#reportList_foldHead").val(foldHead_num);
            }

        }
        else{
            let cut_num = Math.round($("#reportList_cut").val() * 12);
            let foldHead_num = Math.round($("#reportList_foldHead").val() * 12)
            if(cut_num !== 0 ) {
                $("#reportList_cut").text(cut_num + "條");
                $("#reportList_cut").val(cut_num);
            }
            if(foldHead_num !== 0) {
                $("#reportList_foldHead").text(foldHead_num + "條");
                $("#reportList_foldHead").val(foldHead_num);
            }
        }
    })
    $("#reportList_cut").click(function (){
        if($("#reportList_cut").text() !== "尚未回報"){
            $("#ReportModal").modal('hide');
            open_detail_modal($("#reportList_cut").val(),$("#reportList_ticket_id").val(),"剪巾",$('#reportList_unit').val());
            $("#ReportDetailModal").modal('show');
        }
    })
    $("#reportList_foldHead").click(function (){
        if($("#reportList_foldHead").text() !== "尚未回報"){
            $("#ReportModal").modal('hide');
            open_detail_modal($("#reportList_foldHead").val(),$("#reportList_ticket_id").val(),"折頭");
            $("#ReportDetailModal").modal('show');
        }
    })
</script>

