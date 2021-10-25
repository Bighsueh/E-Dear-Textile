@extends('layouts.masters.employee')
@section('content')
    <div class="container">
        @if($position === "1")
            <form action="{{Route('post_create_employee_report')}}" method="POST" class="workSheet">
                @csrf
                <div class="form-group col-md-12">
                    <label for="ticket_id">派遣單編號</label>
                    <input disabled="value" type="text" name="ticket_id" class="form-control" id="ticket_id"
                           placeholder="派遣單編號" value="{{$job_tickets->id}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="employeeName">客戶名稱</label>
                    <input disabled="value" type="text" name="employeeName" class="form-control" id="employeeName" value="{{$job_tickets->employeeName}}"
                           placeholder="客戶名稱">
                </div>
                <div class="form-group col-md-12">
                    <label for="colorId">色線編號</label>
                    <input disabled="value" class="form-control" name="colorId" id="colorId" value="{{$job_tickets->colorId."-".$job_tickets->colorId2}}"
                           placeholder="輸入或點擊選取廠商">
                </div>
                <div class="form-group col-md-12">
                    <label for="wash">洗標</label>
                    <input disabled="value" type="text" name="wash" class="form-control" id="wash" placeholder="洗標" value="{{$job_tickets->wash}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="wash">完成數量</label>
                    <input type="text" name="complete_orders" class="form-control" id="complete_orders" placeholder="完成數量">
                </div>
                <div class="form-group col-md-12">
                    <label for="wash">滾邊員</label>
                    <input type="text" name="pick_cloth_emp" class="form-control" id="pick_cloth_emp" placeholder="滾邊員">
                </div>
                <div class="form-group col-md-12">
                    <label for="date">日期</label>
                    <input type="text" name="date" class="form-control" id="date" placeholder="日期">
                </div>
                <div style="width:800px; display: flex;" class="column">
                    <button style="width: 100px;" type="submit"
                            class="btn_add form-control btn btn-secondary rounded mx-3">
                        確認
                    </button>
                </div>
            </form>
        @elseif($position === "2")
            <form action="{{Route('post_create_employee_report')}}" method="POST" class="workSheet">
                @csrf
                <div class="form-group col-md-12">
                    <label for="ticket_id">派遣單編號</label>
                    <input disabled="value" type="text" name="ticket_id" class="form-control" id="ticket_id"
                           placeholder="派遣單編號" value="{{$job_tickets->id}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="employeeName">客戶名稱</label>
                    <input disabled="value" type="text" name="employeeName" class="form-control" id="employeeName" value="{{$job_tickets->employeeName}}"
                           placeholder="客戶名稱">
                </div>
                <div class="form-group col-md-12">
                    <label for="colorId">色線編號</label>
                    <input disabled="value" class="form-control" name="colorId" id="colorId" value="{{$job_tickets->colorId."-".$job_tickets->colorId2}}"
                           placeholder="輸入或點擊選取廠商">
                </div>
                <div class="form-group col-md-12">
                    <label for="wash">洗標</label>
                    <input disabled="value" type="text" name="wash" class="form-control" id="wash" placeholder="洗標" value="{{$job_tickets->wash}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="wash">完成數量</label>
                    <input type="text" name="complete_orders" class="form-control" id="complete_orders" placeholder="完成數量">
                </div>
                <div class="form-group col-md-12">
                    <label for="wash">撿巾員</label>
                    <input type="text" name="pick_cloth_emp" class="form-control" id="pick_cloth_emp" placeholder="撿巾員">
                </div>
                <div class="form-group col-md-12">
                    <label for="date">日期</label>
                    <input type="text" name="date" class="form-control" id="date" placeholder="日期">
                </div>
                <div style="width:800px; display: flex;" class="column">
                    <button style="width: 100px;" type="submit"
                            class="btn_add form-control btn btn-secondary rounded mx-3">
                        確認
                    </button>
                </div>

            </form>
        @endif
    </div>



@endsection
