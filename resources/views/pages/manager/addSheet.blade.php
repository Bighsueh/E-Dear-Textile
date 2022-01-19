@extends('layouts.masters.manager')
@section('content')
    {{--   要做防呆 不然授權會出錯 然後沒有筆數的時候要處理 --}}
    <div class="container">
        {{--        <div class="row mt-3 justify-content-center">--}}
        {{--            <h1 class="text-center col-lg-12 ">工作分配</h1>--}}
        {{--        </div>--}}
        <form action="{{Route('post_create_addSheet')}}" method="POST" class="workSheet">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ticket_id">派遣單編號</label>
                    <input disabled="value" type="text" name="ticket_id" class="form-control" id="ticket_id"
                           placeholder="派遣單編號" value="{{$id+1}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="date">日期</label>
                    <input type="text" name="date" class="form-control" id="date" placeholder="日期">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="customer_name">客戶名稱</label>
                    <select type="text" name="customer_name" class="form-control" id="customer_name" placeholder="客戶名稱"
                            required>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="item">品項</label>
                    <select type="text" name="item" class="form-control" id="item" placeholder="品項" required>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="item_no">貨號</label>
                    <select name="item_no" class="form-control" id="item_no" placeholder="貨號" required>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="blenching_and_dyeing_factory">漂染廠</label>
                    <select type="text" name="blenching_and_dyeing_factory" class="form-control" id="blenching_and_dyeing_factory" placeholder="漂染廠" required>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="color">顏色</label>
                    <select type="text" name="color" class="form-control" id="color" placeholder="顏色" required>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="color_thread">色線編號</label>
                    <select class="form-control" name="color_thread" id="color_thread" placeholder="輸入色線編號" required>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="wash_tag">洗標</label>
                    <select type="text" name="wash_tag" class="form-control" id="wash_tag" placeholder="洗標" required>

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="piping_method">滾邊方式</label>
                    <select type="text" name="piping_method" class="form-control" id="piping_method" placeholder="滾邊方式" required>

                    </select>
                </div>
            </div>
            {{--        訂單數量未調整        --}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="order">訂單數量</label>
                    <input type="text" name="order" class="form-control" id="order" placeholder="訂單數量" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="order_unit">訂單單位</label>
                    <select type="text" name="order_unit" class="form-control" id="order_unit" placeholder="單位"
                            required>
                        <option value="1" selected>條</option>
                        <option value="12">打</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="manager">派工主管</label>
                <input type="text" name="manager" class="form-control" id="manager" readonly value="{{$user_name}}"
                       placeholder="派工主管" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="remark">備註</label>
                    <select type="text" name="remark" class="form-control" id="remark" placeholder="備註">

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="ticket_status">貨別</label>
                    <select class="form-control" name="ticket_status" id="ticket_status"
                            placeholder="輸入或點擊選取狀態">
                    </select>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <button  type="submit"
                        class="col-md-10 btn_add form-control btn btn-secondary rounded mx-3">
                    儲存
                </button>
            </div>
        </form>
    </div>

    <script>

        $("#customer_name").select(
            function () {
                const chinese = $("#customer_name").val().split("-")[0];
                const eng = $("#customer_name").val().split("-")[1];
                $("#wash_tag").val(chinese);
                $("#item_no").val(eng);
                $("#wash_tag").editableSelect('filter');
                $("#item_no").editableSelect('filter');
            }
        )
        show_default_value();
        function show_default_value() {
            let url = "{{route('get_default')}}";
            $.ajax({
                url: url,
                method: 'get',
                success: function (res) {
                    $.each(res, function (index, row) {
                        $.each(row, function (index, value) {
                            if (value != null) {
                                $("#"+index).append($('<option>', {
                                    text: value,
                                }));
                            }
                        });
                    });
                    $("#item_no").editableSelect({efficts: 'slide'});
                    $("#color").editableSelect({efficts: 'slide'});
                    $("#wash_tag").editableSelect({efficts: 'slide'});
                    $("#item").editableSelect({efficts: 'slide'});
                    $("#blenching_and_dyeing_factory").editableSelect({efficts: 'slide'});
                    $("#color_thread").editableSelect({efficts: 'slide'});
                    $("#piping_method").editableSelect({efficts: 'slide'});
                    $("#ticket_status").editableSelect({efficts: 'slide'});
                    $("#customer_name").editableSelect({efficts: 'slide'});
                    $("#remark").editableSelect({efficts: 'slide'});
                },
                error: function (res) {
                    console.log('error');
                },


            })
        }
        ;(function () {

            const d = new Date()
            const date = document.getElementById("date");
            date.value = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate() + " " + d.getHours() + ":" + d.getMinutes();
            document.getElementById("btn_open_scanner").addEventListener("click", function () {
                //獲取系統裝置資訊
                let agent = navigator.userAgent.toLowerCase();

                //若裝置為 Android
                if (agent.includes("android")) {
                    window.location.href = "app://open";
                    send_get_open_scanner();
                }
                //若裝置為 iphone
                else if (agent.includes("iphone")) {
                    document.getElementById("camera_link_for_iphone").click();
                    send_get_open_scanner();
                }
                //其他裝置
                else {
                    window.alert("此功能僅限於Android或ios裝置使用!");
                }
            })

        })()



    </script>
@endsection


