@extends('layouts.masters.manager')
@section('content')
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
                        <input type="text" name="employeeName" class="form-control" id="employeeName"
                               placeholder="客戶名稱">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="item">品項</label>
                        <input type="text" name="item" class="form-control" id="item" placeholder="品項">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="itemId">貨號</label>
                        <input type="text" name="itemId" class="form-control" id="itemId" placeholder="貨號">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="factory">漂染廠</label>
                        <input type="text" name="factory" class="form-control" id="factory" placeholder="漂染廠">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="color">顏色</label>
                        <input type="text" name="color" class="form-control" id="color" placeholder="顏色">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="colorId">色線編號</label>
                        <input class="form-control" list="ColorLines" name="colorId" id="colorId" value=""
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
                        <input type="text" name="wash" class="form-control" id="wash" placeholder="洗標">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="colorId2">色線編號2</label>
                        <input type="text" name="colorId2" class="form-control" id="colorId2" placeholder="色線編號">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cloth">布單數量</label>
                        <input type="text" name="cloth" class="form-control" id="cloth" placeholder="布單數量">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rollFunc">滾邊方式</label>
                        <input type="text" name="rollFunc" class="form-control" id="rollFunc" placeholder="滾邊方式">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="manager">派工主管</label>
                        <input type="text" name="manager" class="form-control" id="manager" placeholder="派工主管">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="order">訂單數量</label>
                        <input type="text" name="order" class="form-control" id="order" placeholder="訂單數量">
                    </div>
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
                    <button style="width: 100px;" type="button"
                            class="btn_qrcode form-control btn btn-secondary rounded mr-3">QR code
                    </button>
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
        <footer class=" footer text-center text-lg-start bg-dark text-muted mt-3">
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">

            </div>
        </footer>

        <script>
        const d = new Date()
        const date = document.getElementById("date");
        date.value = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
    </script>
@endsection


