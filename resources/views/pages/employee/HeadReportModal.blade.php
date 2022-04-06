<div class="modal fade" id="HeadReportModal" tabindex="-1" role="dialog" aria-labelledby="HeadReportModalTitle" aria-hidden="true">
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
                    <div class="row form-group">
                        <label for="head_item" class="col-sm-3 col-5 ">品項</label>
                        <input class="form-control col-sm-8 col-7" id="head_item" type="text" readonly/>
                    </div>
                    <br>
                    <div class="row form-group">
                        <label class="col-sm-12 col-12">折頭員完成數量</label>
                        <div class="col-sm-12 col-12 row">
                            <input id="head_report-operator-name" class="form-control col-sm-11 col-11 mx-auto mb-2"
                                   value="折頭name" readonly/>
                        </div>
                        <div class="col-sm-12 col-12 row">
                            <input class="form-control col-sm-7 col-7 mx-auto" id="head_operator_num"
                                   placeholder="請輸入數量" type="text"/>
                            <select id="head-operator-unit" class="form-control col-sm-3 col-3 mx-auto">
                                <option value="one" selected>條</option>
                                <option value="dozen">打</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 col-12">撿巾員完成數量</label>
                        <table id="report_pick_list">
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
                <button type="button" class="btn btn-outline-success" id="btn_head_report">送出回報</button>
            </div>
        </div>
    </div>
</div>
<script>
    let temp_pick_row;
    let emtpy_pick_row = $("#report_pick_list").html();

    function open_head_modal(ticket_id) {
        const d = new Date();
        url = "{{route('get_report_data')}}";
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                ticket_id: ticket_id,
                action: '折頭',
                created_at:d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate()+" "+d.getHours()+":"+d.getMinutes()
            },
            success: function (res) {
                console.log(res);
                set_head_modal(res);
            },
            error: function (err) {
                console.log(err);
            }
        })
    }
    //格式化撿巾員列
    function format_picke_row() {
        $("#report_pick_list").html(emtpy_pick_row)
    }
    //產生新撿巾員列
    function create_pick_row() {
        $("#report_pick_list").append(temp_pick_row);
    }
    //增加撿巾員輸入列
    $("#btn_add_picks").click(function () {
        create_pick_row();
    });
        //設置回報頁欄位資訊
        function set_head_modal(data) {
            //派遣單編號
            document.getElementById('head_ticket_id').value =
                data['ticket_reports'][0]['ticket_id'];
            //客戶名稱
            document.getElementById('head_customer_name').value =
                data['ticket_reports'][0]['employeeName'];
            // //色線編號
            document.getElementById('head_color_cable').value =
                data['ticket_reports'][0]['color_line'];
            // //洗標
            document.getElementById('head_wash_tag').value =
                data['ticket_reports'][0]['wash'];
            // //品項
            document.getElementById('head_item').value =
                data['ticket_reports'][0]['item'];

            //折頭員名稱
            document.getElementById('head_report-operator-name').value =
                data['ticket_reports'][0]['name'];
            //折頭員回報數量
            document.getElementById('head_operator_num').value =
                data['ticket_reports'][0]['quantity'];
            //折頭員回報數量之單位
            document.getElementById('head-operator-unit').value =
                data['ticket_reports'][0]['unit'];
            //
            //最後回報時間
            document.getElementById('head_time').value =
                data['ticket_reports'][0]['updated_at']
            //
            //先把撿巾員列格式化
            format_picke_row();

            //撿巾員選項填入
            $(".pick-select").empty();
            $.each(data['picks_members'], function (index, row) {
                $(".pick-select").append(
                    "<option value=" + row['id'] + ">" + row['name'] + "</option>"
                );
            })

            //設定動態產生用的空白列
            temp_pick_row = $("#report_pick_list").html();

            // //將資料寫入撿巾員列表內
            let pick_last_row = $("#report_pick_list tr").last().children();
            let pick_last_people = pick_last_row.children('.pick-people > select');
            let pick_last_number = pick_last_row.children('.pick-number > input');
            let pick_last_unit = pick_last_row.children('.pick-unit > select');

            //若pick_reports有資料則寫入
            if (data["pick_reports"].length !== 0) {
                //因為第一列已經存在所以直接寫入資料
                pick_last_number.val(data["pick_reports"][0]["quantity"]);
                pick_last_unit.val(data["pick_reports"][0]["unit"]);
                for (let i = 1; i < data["pick_reports"].length; i++) {
                    //產生新的一列
                    create_pick_row();
                    //重新定義最後一行
                    pick_last_row = $("#report_pick_list tr").last().children();
                    pick_last_people = pick_last_row.children('.pick-people > select');
                    pick_last_number = pick_last_row.children('.pick-number > input');
                    pick_last_unit = pick_last_row.children('.pick-unit > select');
                    //寫入資料
                    pick_last_people.val(data["pick_reports"][i]["operator"]);
                    pick_last_number.val(data["pick_reports"][i]["quantity"]);
                    pick_last_unit.val(data["pick_reports"][i]["unit"]);

                }
            }

            $("#HeadReportModal").modal('show');
        }

    //送出回報按鈕
    $("#btn_head_report").click(function (){
        store_head_data()
    })



    //儲存回報結果
    function store_head_data() {
        let ticket_id = document.getElementById('head_ticket_id').value;
        let pick_list = get_pick_list_array();
        let operator_name = document.getElementById('head_report-operator-name').value;
        let operator_number = document.getElementById('head_operator_num').value;
        let operator_unit = document.getElementById('head-operator-unit').value;
        const d = new Date();

        $.ajax({
            url:'{{route('store_report_data')}}',
            method: 'GET',
            data: {
                ticket_id: ticket_id,
                piping_list: pick_list,
                action: '折頭',
                operator_number: operator_number,
                operator_unit: operator_unit,
                updated_at:d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate()+" "+d.getHours()+":"+d.getMinutes()
            },
            success: function (res) {
                console.log(res);
                window.alert("回報完成");
                $("#HeadReportModal").modal("hide");
            },
            error: function (err) {
                console.log(err);
            }
        })
    }

    //取得頁面中撿巾員回報資訊
    function get_pick_list_array() {
        let pick_people;
        let pick_number;
        let pick_unit;
        let pick_list = [];
        container = $("#report_pick_list tr").each(function (index, tr) {
            // console.log($(this).children().find());
            //滾邊員
            pick_people = $(this).find(".pick-people > select > option:selected").val();
            //數量
            pick_number = $(this).find(".pick-number > input").val();
            //單位
            pick_unit = $(this).find(".pick-unit > select > option:selected").val();

            //將資料push進array:pick_list裡面
            pick_list.push([pick_people, pick_number, pick_unit])
        });
        return pick_list;
    }

</script>



