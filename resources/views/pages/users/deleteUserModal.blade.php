<!-- Modal -->
<div class="modal fade" id="DeleteUserModal" tabindex="-1" role="dialog" aria-labelledby="DeleteUserModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="DeleteUserModalLabel" style="">刪除使用者</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        確定要刪除以下使用者嗎？<br>
                        名稱：<a id="tag_delete_user_id"></a>
                    </div>
                    <input type="hidden" class="delete_user_id" id="delete_user_id"/>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" id="btn_delete_yes" class="btn btn-success">確定</button>
                <button type="button" id="btn_delete_no" class="btn btn-danger close-modal">取消</button>
            </div>
        </div>
    </div>
</div>
<script>
    //刪除使用者
    function delete_user_data(id) {
        $.ajax({
            url: '{{route('delete_edit_data')}}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                user_id: id,
            },
            success: function (res) {
                update_data();
            },
            error: function (err) {
                console.log(err)
            }

        })
    }

    //"確認刪除"按鈕
    $("#btn_delete_yes").click(function () {
        delete_user_data($("#delete_user_id").val());
        $("#DeleteUserModal").modal('hide');
    })

</script>
