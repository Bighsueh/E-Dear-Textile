<!-- Modal -->
<div class="modal fade" id="ConfirmIdentity" tabindex="-1" role="dialog" aria-labelledby="ConfirmIdentityTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{--        <div class="modal-header">--}}
            {{--            <h5 class="modal-title" id="ConfirmIdentityLongTitle">身分確認</h5>--}}
            {{--        </div>--}}
            <div class="modal-body">
                <div class="container">

                    <div class="row form-group justify-content-center">
                        <label class="form-group">請輸入欲查詢顧客名稱</label>
                    </div>
                    <div class="row form-group justify-content-center">

                        <select class="form-control col-6" id="confirm_customer_name" name="confirm_customer_name"
                                required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                        <button type="button" class="btn btn-outline-success ml-2" id="btn_confirm_customer">開始</button>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        //一載入畫面則跳出modal
        $('#ConfirmIdentity').modal('show');

        //設定editableSelect
        $("#confirm_customer_name").editableSelect({efficts: 'slide'})

        //設定點選modal外部不會關閉
        $("#ConfirmIdentity").modal({
            backdrop: 'static',
            keyboard: false
        });

        $("#btn_confirm_customer").click(function(){
            let customer_name = $("#confirm_customer_name").val();
            confirm_customer_name = confirm_customer_data(customer_name);
        })
    });

    function confirm_customer_data(customer_name,search_parameter = null) {
        let url = ""
        $.ajax({
            url : url,
            method : "post",
            data:{
                customer_name : customer_name,
            },
            success: function(res){

                console.log(res);
            },
            error: function(err){
                console.log(err);
            }
        })
    }

</script>
