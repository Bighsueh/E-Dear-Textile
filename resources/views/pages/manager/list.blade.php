@extends('layouts.masters.manager')
@section('content')
    <div class="container">
        {{--        <div class="row mt-3 justify-content-center">--}}
        {{--            <h1 class="text-center col-lg-12 ">工作分配</h1>--}}
        {{--        </div>--}}
        <form action="{{Route('patch_patchSheet')}}" method="POST" class="workSheet">
            @method('PATCH')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ticket_id">派遣單編號</label>
                    <input readonly="readonly" type="text" name="ticket_id" class="form-control" id="ticket_id"
                           placeholder="派遣單編號" value="{{$job_tickets->id}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="date">日期</label>
                    <input type="text" name="date" class="form-control" id="date" placeholder="日期"
                           value="{{$job_tickets->created_at}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employeeName">客戶名稱</label>
                    <select type="text" name="employeeName" class="form-control" value="{{$job_tickets->employeeName}}"
                            id="employeeName" placeholder="客戶名稱" required>
                        @foreach($default_ticket_contents as $row)
                            <option value="{{$row->customer_name}}">{{$row->customer_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="item">品項</label>
                    <select type="text" name="item" class="form-control" id="item" value="{{$job_tickets->item}}"
                            placeholder="品項" required>
                        @foreach($default_ticket_contents as $row)
                            <option value="{{$row->item}}">{{$row->item}}</option>
                        @endforeach
                        <option value="毛巾">毛巾</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="itemId">貨號</label>
                    <select name="itemId" class="form-control" id="itemId"
                            value="{{$job_tickets->itemId}}" placeholder="貨號" required>
                        @foreach($default_ticket_contents as $row)
                            <option value="{{$row->item_no}}">{{$row->item_no}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="factory">漂染廠</label>
                    <select type="text" name="factory" class="form-control" id="factory"
                            value="{{$job_tickets->factory}}"
                            placeholder="漂染廠" required>
                        @foreach($default_ticket_contents as $row)
                            <option value="{{$row->blenching_and_dyeing_factory}}">{{$row->blenching_and_dyeing_factory}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="color">顏色</label>
                    <select type="text" name="color" class="form-control" id="color"
                            value="{{$job_tickets->color}}" placeholder="顏色" required>
                        @foreach($default_ticket_contents as $row)
                            <option value="{{$row->color}}">{{$row->color}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="color_line">色線編號</label>
                    <select class="form-control" name="color_line" id="color_line" value="{{$job_tickets->color_line}}"
                            placeholder="輸入或點擊選取廠商" required>
                        @foreach($default_ticket_contents as $row)
                            <option value="{{$row->color_thread}}">{{$row->color_thread}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="wash">洗標</label>
                    <select type="text" name="wash" class="form-control" id="wash"
                            value="{{$job_tickets->wash}}" placeholder="洗標" required>
                        @foreach($default_ticket_contents as $row)
                            <option value="{{$row->wash_tag}}">{{$row->wash_tag}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="rollFunc">滾邊方式</label>
                    <select type="text" name="rollFunc" class="form-control" id="rollFunc" placeholder="滾邊方式"
                            value="{{$job_tickets->rollFunc}}" required>
                        @foreach($default_ticket_contents as $row)
                            <option value="{{$row->piping_method}}">{{$row->piping_method}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="order_dozen">訂單數量(打)</label>
                    <input type="text" name="order_dozen" class="form-control" id="order_dozen" placeholder="訂單數量(打)"
                           value="{{(round($job_tickets->order/12-0.5))}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="order_bar">訂單數量(條)</label>
                    <input type="text" name="order_bar" class="form-control" id="order_bar" placeholder="訂單數量(條)"
                           value="{{($job_tickets->order%12)}}">
                </div>
            </div>
            <div class="form-group">
                <label for="manager">派工主管</label>
                <input type="text" name="manager" class="form-control" id="manager" placeholder="派工主管"
                       value="{{$job_tickets->manager}}" readonly>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ps">備註</label>
                    <input type="text" name="ps" class="form-control" id="ps" placeholder="備註"
                           value="{{$job_tickets->ps}}">
                </div>
                <div class="form-group col-md-6">

                    <label for="status">貨別</label>
                    <select class="form-control" name="status" id="status" value="{{$job_tickets->status}}"
                            placeholder="輸入或點擊選取狀態">
                        @foreach($default_ticket_contents as $row)
                            <option value="{{$row->ticket_status}}">{{$row->ticket_status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="column row justify-content-between px-5 mb-5">

                {{--                <input type="button" class="btn btn-secondary" value="Qrcode授權"--}}
                {{--                       onclick="document.getElementById('btn_qrcode').click()"/>--}}
                <button type="button" id="QRcodeAuthButton" data-toggle="modal" class="btn btn-secondary col-md mx-1"
                        data-target="#QRcodeAuth">Qrcode授權
                </button>
                <button type="submit"
                        class="btn_add form-control btn btn-secondary rounded col-md mx-1">
                    儲存
                </button>
                <button type="button"
                        class="btn_print form-control btn btn-secondary rounded col-md mx-1" onclick="window.print()">列印
                </button>
            </div>
        </form>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="QRcodeAuth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="exampleModalLabel" style="">QR Code授權</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="text-center">
                            請選擇授權對象為滾邊或折頭<br>
                            (此功能僅供手機端使用)
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" id="btn_piping" class="btn btn-secondary">滾邊員</button>
                    <button type="button" id="btn_foldhead" class="btn btn-secondary">折頭員</button>
                </div>
            </div>
        </div>
        <form id="form_ManagerToFoldHead" action="{{url('/openScanner/ManagerToFoldHead/'.$job_tickets->id)}}"></form>
        <form id="form_ManagerToPiping" action="{{url('/openScanner/ManagerToPiping/'.$job_tickets->id)}}"></form>
        <input id="camera_link_for_iphone" type="file" accept="image/*" style="display: none;" capture/>
        <script>
            $(document).ready(function(){
                let customer_name = "{{$job_tickets->employeeName}}";
                $("#employeeName").val(customer_name);
            })
            ;(function () {
                //判斷系統
                function agent() {
                    //獲取系統裝置資訊
                    let agent = navigator.userAgent.toLowerCase();

                    //若裝置為 Android
                    if (agent.includes("android")) {
                        window.location.href = "app://open";
                    }
                    //若裝置為 iphone
                    else if (agent.includes("iphone")) {
                        document.getElementById("camera_link_for_iphone").click();
                    }
                    //其他裝置
                    else {
                        window.alert("此功能僅限於Android或ios裝置使用!");
                    }
                }

                //滾邊
                document.getElementById('btn_piping').addEventListener('click', function () {
                    agent();
                    document.getElementById('form_ManagerToPiping').submit();
                });

                //折頭
                document.getElementById('btn_foldhead').addEventListener('click', function () {
                    agent();
                    document.getElementById('form_ManagerToFoldHead').submit();
                });
                $("#itemId").editableSelect({efficts: 'slide'})
                $("#color").editableSelect({efficts: 'slide'})
                $("#wash").editableSelect({efficts: 'slide'})
                $("#item").editableSelect({efficts: 'slide'})
                $("#factory").editableSelect({efficts: 'slide'})
                $("#color_line").editableSelect({efficts: 'slide'})
                $("#rollFunc").editableSelect({efficts: 'slide'})
                $("#status").editableSelect({efficts: 'slide'})
            })()


        </script>
    </div>
@endsection


