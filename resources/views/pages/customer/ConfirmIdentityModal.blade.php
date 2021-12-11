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
                        <h5 class="form-group">請輸入欲查詢顧客名稱：</h5>
                    </div>
                    <div class="row form-group justify-content-center">
                        <label id="confirm_msg" class="text-danger"></label>
                    </div>
                    <div class="row form-group justify-content-center">

                        <select class="form-control col-6" id="confirm_customer_name" name="confirm_customer_name"
                                required>
                            <option value="1">1</option>
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
        var confirm_customer_name = false;

        //設定點選modal外部不會關閉
        $("#ConfirmIdentity").modal({
            backdrop: 'static',
            keyboard: false
        });

        //設定editableSelect
        $("#confirm_customer_name").editableSelect({efficts: 'slide'})


        //顧客名稱查詢按鈕
        $("#btn_confirm_customer").click(function () {
            let customer_name = $("#confirm_customer_name").val();

            confirm_customer(customer_name);


            if (updated_confirm_customer_name()) {
                //更新頁面
                update_tickets_list();
            }
        })

        //物件都設定完則跳出modal1
        $('#ConfirmIdentity').modal('show');
    });
    function set_confirm_msg(msg){
        $("#confirm_msg").text(msg)
    }

    function close_confirm_modal() {
        $("#ConfirmIdentity").modal('hide');
    }

    //更新驗證顧客狀態
    function updated_confirm_customer_name(status = null) {
        if (status !== null) {
            confirm_customer_name = status;
        }
        return confirm_customer_name;
    }



    //判斷顧客是否存在
    function confirm_customer(customer_name) {
        let url = "{{route('confirm_customer')}}";

        $.ajax({
            url: url,
            method: "GET",
            async: false,
            data: {
                customer_name: customer_name,
            },
            success: function (res) {
                if (res === 'exist') {
                    console.log('customer exist');
                    updated_confirm_customer_name(true);
                }
                if (res === 'not exist') {
                    console.log('customer not exist');

                    set_confirm_msg('查無此客戶，請重新輸入!');

                    updated_confirm_customer_name(false);
                }
            },
            error: function (res) {
                console.log(res);
                updated_confirm_customer_name(false);
            }
        })


    }

</script>
