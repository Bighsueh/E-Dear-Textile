<!-- Modal -->
<div class="modal fade" id="CreateUserModal" tabindex="-1" role="dialog" aria-labelledby="CreateUserModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateUserModalLongTitle">新增使用者</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row form-group">
                        <label for="create_level" class="col-sm-4 text-right">選擇職位</label>
                        <select class="form-control col-sm-6" aria-label="Default select example"
                                name="create_level" id="create_level">
                            <option value="employee">員工</option>
                            <option value="manager">幹部</option>
                        </select>
                    </div>
                    <div class="row form-group">
                        <label for="create_name" class="col-sm-4 text-right">請輸入名稱</label>
                        <input type="text" name="create_name" id="create_name" class="form-control col-sm-6"
                               placeholder="員工名稱"/>
                    </div>
                    <div class="row form-group">
                        <label for="create_account" class="col-sm-4 text-right">請輸入帳號</label>
                        <input type="text" name="create_account" id="create_account" class="form-control col-sm-6"
                               placeholder="帳號"/>
                    </div>
                    <div class="row form-group">
                        <label for="create_password" class="col-sm-4 text-right">請輸入密碼</label>
                        <input type="text" name="create_password" id="create_password" class="form-control col-sm-6"
                               placeholder="密碼"/>
                    </div>
                </div>
                <input type="hidden" value="" name="edit_id" id="edit_id"/>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" id="btn_create_user">新增使用者</button>
            </div>
        </div>
    </div>
</div>
<script>
    //頁面最上方新增使用者按鈕點擊事件
    $("#btn_create_user").click(function () {
        $.ajax({
            url: '{{route('create_user_data')}}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                create_level: $("#create_level").val(),
                create_name: $("#create_name").val(),
                create_account: $("#create_account").val(),
                create_password: $("#create_password").val(),
            },
            success: function (res) {
                if (res === "success") {
                    window.alert("新增成功");
                }
                $("#create_level").val('employee');
                $("#create_name").val('');
                $("#create_account").val('');
                $("#create_password").val('');
                update_data();
            },
            error: function (err) {
                window.alert('新增失敗：\n' + err['responseJSON']["message"]);
                console.log(err['responseJSON']["message"]);

            }
        })
    })
</script>
