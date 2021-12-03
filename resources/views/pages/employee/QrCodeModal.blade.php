<!-- Modal -->
<div class="modal fade" id="QRcodeModal" tabindex="-1" role="dialog" aria-labelledby="QRcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="QRcodeModalLabel" style=""> 此QR Code僅供剪巾員進行掃描  </h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <br>
                    <div id="qrcode-canvas"></div>

                </div>
            </div>
            <div class="modal-footer align-items-end form-group">
                <a class="form-group form-group" id="customer_name">
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    function open_qrcode_modal(ticket_id, employee_name) {
        url = "{{url('/afterScan')}}";
        user_id = {{\Illuminate\Support\Facades\Session::get('user_id')}};
        $("#customer_name").text("廠商："+employee_name);
        $('#qrcode-canvas').empty();
        $('#qrcode-canvas').qrcode(url + "?ticket_id=" + ticket_id + "&user_id=" + user_id);
        $('#QRcodeModal').modal('show');
    }

    $(".btn-open-qrcode-modal").click(function () {
        employee_name = $(this).parent().parent().children(".employee-name").text().trim();
        ticket_id = $(this).parent().parent().children(".ticket-id").children(".ticket-id").text().trim();
        open_qrcode_modal(ticket_id,employee_name)
    })



</script>
