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
                               placeholder="派遣單編號" value="{{$id->id+1}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">日期</label>
                        <input type="text" name="date" class="form-control" id="date" placeholder="日期">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="employeeName">客戶名稱</label>
                        <input type="text" name="employeeName" class="form-control" id="employeeName" required
                               placeholder="客戶名稱">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="item">品項</label>
                        <input type="text" name="item" class="form-control" id="item" placeholder="品項" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="itemId">貨號</label>
                        <input type="text" name="itemId" class="form-control" id="itemId" placeholder="貨號" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="factory">漂染廠</label>
                        <input type="text" name="factory" class="form-control" id="factory" placeholder="漂染廠" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="color">顏色</label>
                        <input type="text" name="color" class="form-control" id="color" placeholder="顏色" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="colorId">色線編號</label>
                        <input class="form-control" list="ColorLines" name="colorId" id="colorId" value=""
                               placeholder="輸入或點擊選取廠商" required>
                        <datalist id="ColorLines">
                            <option>聯訪</option>
                            <option>廣秦</option>
                        </datalist>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="wash">洗標</label>
                        <input type="text" name="wash" class="form-control" id="wash" placeholder="洗標" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="colorId2">色線編號2</label>
                        <input type="text" name="colorId2" class="form-control" id="colorId2" placeholder="色線編號" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cloth">布單數量</label>
                        <input type="text" name="cloth" class="form-control" id="cloth" placeholder="布單數量" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rollFunc">滾邊方式</label>
                        <input type="text" name="rollFunc" class="form-control" id="rollFunc" placeholder="滾邊方式" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="order_dozen">訂單數量(打)</label>
                        <input type="text" name="order_dozen" class="form-control" id="order_dozen" placeholder="訂單數量(打)" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="order_bar">訂單數量(條)</label>
                        <input type="text" name="order_bar" class="form-control" id="order_bar" placeholder="訂單數量(條)" required>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="manager">派工主管</label>
                    <input type="text" name="manager" class="form-control" id="manager" placeholder="派工主管" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ps">備註</label>
                        <input type="text" name="ps" class="form-control" id="ps" placeholder="備註">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status">狀態</label>
                        <input class="form-control" list="statuslists" name="status" id="status"
                               placeholder="輸入或點擊選取狀態">
                        <datalist id="statuslists">
                            <option value="排程中">排程中</option>
                            <option value="刪單">刪單</option>
                            <option value="結單">結單</option>
                        </datalist>
                    </div>
                </div>

                <div style="width:800px; display: flex;" class="column">
                    <form id="form_open_scanner" action="{{url('/openScanner/ManagerToPiping/'.$id->id)}}">
                        <input id="btn_open_scanner" type="button" class="btn btn-secondary" value="Qrcode授權"/>
                        <input id="camera_link_for_iphone" type="file" accept="image/*" style="display: none" capture/>
                    </form>
                    <button style="width: 100px;" type="submit"
                            class="btn_add form-control btn btn-secondary rounded mx-3">
                        儲存
                    </button>
                    <button style="width: 100px;" type="button"
                            class="btn_print form-control btn btn-secondary rounded mx-3" onclick="window.print()">列印
                    </button>
                </div>
            </form>
        </div>

        <script>
            const d = new Date()
            const date = document.getElementById("date");
            date.value = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
            document.getElementById("btn_open_scanner").addEventListener("click",function(){
                //獲取系統裝置資訊
                let agent = navigator.userAgent.toLowerCase();

                //若裝置為 Android
                if (agent.includes("android")){
                    window.location.href = "app://open";
                    $("form_open_scanner").submit();
                }
                //若裝置為 iphone
                else if (agent.includes("iphone")){
                    $("camera_link_for_iphone").click();
                    $("form_open_scanner").submit();
                }
                //其他裝置
                else{
                    window.alert("此功能僅限於Android或ios裝置使用!");
                }
            })
        </script>
@endsection


