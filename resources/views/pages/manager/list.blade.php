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
                           value="{{$job_tickets->date}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employeeName">客戶名稱</label>
                    <input type="text" name="employeeName" class="form-control" id="employeeName"
                           placeholder="客戶名稱" value="{{$job_tickets->employeeName}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="item">品項</label>
                    <input type="text" name="item" class="form-control" id="item" placeholder="品項"
                           value="{{$job_tickets->item}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="itemId">貨號</label>
                    <input type="text" name="itemId" class="form-control" id="itemId" placeholder="貨號"
                           value="{{$job_tickets->itemId}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="factory">漂染廠</label>
                    <input type="text" name="factory" class="form-control" id="factory" placeholder="漂染廠"
                           value="{{$job_tickets->factory}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="color">顏色</label>
                    <input type="text" name="color" class="form-control" id="color" placeholder="顏色"
                           value="{{$job_tickets->color}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="colorId">色線編號</label>
                    <input class="form-control" list="ColorLines" name="colorId" id="colorId"
                           value="{{$job_tickets->colorId}}"
                           placeholder="輸入或點擊選取廠商">
                    <datalist id="ColorLines">
                        <option>聯訪</option>
                        <option>廣秦</option>
                    </datalist>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="wash">洗標</label>
                    <input type="text" name="wash" class="form-control" id="wash" placeholder="洗標"
                           value="{{$job_tickets->wash}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="colorId2">色線編號2</label>
                    <input type="text" name="colorId2" class="form-control" id="colorId2" placeholder="色線編號"
                           value="{{$job_tickets->colorId2}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cloth">布單數量</label>
                    <input type="text" name="cloth" class="form-control" id="cloth" placeholder="布單數量"
                           value="{{$job_tickets->cloth}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="rollFunc">滾邊方式</label>
                    <input type="text" name="rollFunc" class="form-control" id="rollFunc" placeholder="滾邊方式"
                           value="{{$job_tickets->rollFunc}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="manager">派工主管</label>
                    <input type="text" name="manager" class="form-control" id="manager" placeholder="派工主管"
                           value="{{$job_tickets->manager}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="order">訂單數量</label>
                    <input type="text" name="order" class="form-control" id="order" placeholder="訂單數量"
                           value="{{$job_tickets->order}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="ps">備註</label>
                    <input type="text" name="ps" class="form-control" id="ps" placeholder="備註"
                           value="{{$job_tickets->ps}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="status">狀態</label>
                    <input class="form-control" list="statuslists" name="status" id="status"
                           placeholder="輸入或點擊選取狀態" value="{{$job_tickets->status}}">
                    <datalist id="statuslists">
                        <option value="排程中">排程中</option>
                        <option value="刪單">刪單</option>
                        <option value="結單">結單</option>
                    </datalist>
                </div>
            </div>

            <div style="width:800px; display: flex;" class="column">

{{--                <input type="button" class="btn btn-secondary" value="Qrcode授權"--}}
{{--                       onclick="document.getElementById('btn_qrcode').click()"/>--}}
                <button type="button" id="QRcodeAuthButton" data-toggle="modal" class="btn btn-secondary"
                        data-target="#QRcodeAuth">Qrcode授權</button>
                <button style="width: 100px;" type="submit"
                        class="btn_add form-control btn btn-secondary rounded mx-3">
                    儲存
                </button>
                <button style="width: 100px;" type="button"
                        class="btn_print form-control btn btn-secondary rounded mx-3">列印
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
                            請選擇授權對象之為滾邊或折頭<br>
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
        <script>
            ;(function () {
                //滾邊
                document.getElementById('btn_piping').addEventListener('click',function(){
                    document.getElementById('form_ManagerToPiping').submit();
                });

                //折頭
                document.getElementById('btn_foldhead').addEventListener('click',function(){
                    document.getElementById('form_ManagerToFoldHead').submit();
                });
            })()
        </script>
    </div>
@endsection


