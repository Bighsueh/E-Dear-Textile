<div class="modal fade" id="EditUserModal" tabindex="-1" role="dialog" aria-labelledby="EditUserModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditUserModalLongTitle">編輯使用者</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row form-group">
                        <label for="edit_level" class="col-sm-4 text-right">選擇職位</label>
                        <select class="form-control col-sm-6" aria-label="Default select example"
                                name="edit_level" id="edit_level">
                            <option value="employee">員工</option>
                            <option value="manager">幹部</option>
                        </select>
                    </div>
                    <div class="row form-group">
                        <label for="create_name" class="col-sm-4 text-right">請輸入名稱</label>
                        <input type="text" name="edit_name" id="edit_name" class="form-control col-sm-6"
                               placeholder="員工名稱"/>
                    </div>
                    <div class="row form-group">
                        <label for="edit_account" class="col-sm-4 text-right">請輸入帳號</label>
                        <input type="text" name="edit_account" id="edit_account" class="form-control col-sm-6"
                               placeholder="帳號"/>
                    </div>
                    <div class="row form-group">
                        <label for="edit_password" class="col-sm-4 text-right">請輸入密碼</label>
                        <input type="text" name="edit_password" id="edit_password" class="form-control col-sm-6"
                               placeholder="密碼"/>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" id="btn_store_edit_user">儲存編輯</button>
            </div>
        </div>
    </div>
</div>
<script>
    //設定row,編輯按鈕事件
    $("#btn_store_edit_user").click(function () {
        store_edit_user_modal()
        $("#EditUserModal").modal('hide');
    })

    //開啟edit_user_modal ->帶值進去
    function open_edit_user_modal(id,is_admin) {
        $.ajax({
            url: '{{route('get_edit_data')}}',
            method: 'get',
            data: {
                user_id: id,
            },
            success: function (res) {
                $("#edit_level").val('employee');
                $("#edit_name").val(res[0]["name"]);
                $("#edit_account").val(res[0]["account"]);
                $("#edit_password").val(res[0]["password"]);
                $("#edit_id").val(res[0]["id"]);


                if (is_admin) {
                    $("#edit_level").prop('disabled',true);
                    $("#edit_name").prop('disabled',true);
                    $("#edit_account").prop('disabled',true);

                    $("#edit_level").val('admin');
                }else{
                    $("#edit_level").prop('disabled',false);
                    $("#edit_name").prop('disabled',false);
                    $("#edit_account").prop('disabled',false);
                }


                $("#EditUserModal").modal('show');
            }

        });
    }

    //store 以編輯之edit_user_modal
    function store_edit_user_modal() {
        $.ajax({
            url: '{{route('store_edit_data')}}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                edit_id: $("#edit_id").val(),
                edit_level: $("#edit_level").val(),
                edit_name: $("#edit_name").val(),
                edit_account: $("#edit_account").val(),
                edit_password: $("#edit_password").val(),
            },
            success: function (res) {
                if (res === "success") {
                    window.alert("儲存成功");
                }
                $("#edit_level").val('employee');
                $("#edit_name").val('');
                $("#edit_account").val('');
                $("#edit_password").val('');
                update_data();
            },
            error: function (err) {
                window.alert('儲存失敗：\n' + err['responseJSON']["message"]);
                console.log(err['responseJSON']["message"]);

            }
        })
    }
</script>
