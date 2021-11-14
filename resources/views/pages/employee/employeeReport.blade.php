@extends('layouts.masters.employee')
@section('content')
    <div class="container">
        @if($job_title->title === "剪巾")
            @foreach($job_tickets as $job_ticket)
                <form action="{{Route('post_create_employee_report')}}" method="POST" class="workSheet">
                    @csrf
                    <div class="form-group">
                        <label for="ticket_id">派遣單編號</label>
                        <input readonly="readonly" type="text" name="ticket_id" class="form-control" id="ticket_id"
                               placeholder="派遣單編號" value="{{$job_ticket->id}}">
                    </div>
                    <div class="form-group">
                        <label for="employeeName">客戶名稱</label>
                        <input readonly="readonly" type="text" name="employeeName" class="form-control"
                               id="employeeName" value="{{$job_ticket->employeeName}}"
                               placeholder="客戶名稱">
                    </div>
                    <div class="form-group">
                        <label for="colorId">色線編號</label>
                        <input readonly="readonly" class="form-control" name="colorId" id="colorId"
                               value="{{$job_ticket->colorId."-".$job_ticket->colorId2}}"
                               placeholder="輸入或點擊選取廠商">
                    </div>
                    <div class="form-group">
                        <label for="wash">洗標</label>
                        <input readonly="readonly" type="text" name="wash" class="form-control" id="wash"
                               placeholder="洗標" value="{{$job_ticket->wash}}">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="complete_bar_orders">滾邊員完成數量(條)</label>
                            <input type="text" name="complete_bar_orders" class="form-control" id="complete_bar_orders"
                                   placeholder="條" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="complete_dozen_orders">滾邊員完成數量(打)</label>
                            <input type="text" class="form-control" id="complete_dozen_orders"
                                   name="complete_dozen_orders" placeholder="打" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cut_complete_orders">剪巾員完成數量(條)</label>
                            <input type="text" name="cut_complete_bar_orders" class="form-control"
                                   id="cut_complete_bar_orders" placeholder="條" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cut_complete_dozen_orders">剪巾員完成數量(打)</label>
                            <input type="text" class="form-control" id="cut_complete_dozen_orders"
                                   name="cut_complete_dozen_orders" placeholder="打" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Piping">滾邊員</label>
                        <select class="form-select form-control" name="Piping" id="Piping">
                            @foreach($Pipings as $Piping)
                                <option value="{{$Piping->authorized_person}}">{{$Piping->authorized_person}}</option>>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">日期</label>
                        <input type="text" readonly="readonly" name="date" class="form-control" id="date"
                               placeholder="日期">
                    </div>
                    <div style="width:800px; display: flex;" class="column">
                        <button type="button" class="btn_add form-control btn btn-secondary rounded mx-3"
                                data-toggle="modal" data-target="#reportModal">
                            回報
                        </button>
                        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">剪巾回報</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table>
                                            <tr>
                                                <td>訂單數量</td>
                                                <td>{{(round($job_ticket->order/12-0.5)).'打'.($job_ticket->order%12).'條'}}</td>
                                            </tr>
                                            <td>剪巾已回報</td>
                                            @if($reports->count())
                                                <td>{{(round($sumReports/12-0.5)).'打'.($sumReports%12).'條'}}</td>
                                            @else
                                                <td>尚未回報</td>
                                            @endif
                                        </table>

                                    </div>
                                    <div class="modal-footer ">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button style="width: 100px;" type="submit" --}}
                                                class="btn_add form-control btn btn-secondary rounded mx-3">
                                            確認
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--                        <button style="width: 100px;" type="submit"--}}
                        {{--                                class="btn_add form-control btn btn-secondary rounded mx-3">--}}
                        {{--                            確認--}}
                        {{--                        </button>--}}
                    </div>
                    <input type="text" name="title" style="display: none" value="{{$job_title->title}}"
                           class="form-control" id="title">
                </form>
            @endforeach
        @elseif($job_title->title === "折頭")
            {{--      這邊還沒測試過 也還沒做完      --}}
            @foreach($job_tickets as $job_ticket)
                <form action="{{Route('post_create_employee_report')}}" method="POST" class="workSheet">
                    @csrf
                    <div class="form-group">
                        <label for="ticket_id">派遣單編號</label>
                        <input readonly="readonly" type="text" name="ticket_id" class="form-control" id="ticket_id"
                               placeholder="派遣單編號" value="{{$job_ticket->id}}">
                    </div>
                    <div class="form-group">
                        <label for="employeeName">客戶名稱</label>
                        <input readonly="readonly" type="text" name="employeeName" class="form-control"
                               id="employeeName" value="{{$job_ticket->employeeName}}"
                               placeholder="客戶名稱">
                    </div>
                    <div class="form-group">
                        <label for="colorId">色線編號</label>
                        <input readonly="readonly" class="form-control" name="colorId" id="colorId"
                               value="{{$job_ticket->colorId."-".$job_ticket->colorId2}}"
                               placeholder="輸入或點擊選取廠商">
                    </div>
                    <div class="form-group">
                        <label for="wash">洗標</label>
                        <input readonly="readonly" type="text" name="wash" class="form-control" id="wash"
                               placeholder="洗標" value="{{$job_ticket->wash}}">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="complete_bar_orders">折頭員完成數量(條)</label>
                            <input type="text" name="complete_bar_orders" class="form-control" id="complete_bar_orders"
                                   placeholder="條" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="complete_dozen_orders">折頭員完成數量(打)</label>
                            <input type="text" class="form-control" id="complete_dozen_orders"
                                   name="complete_dozen_orders" placeholder="打" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cut_complete_orders">撿巾員完成數量(條)</label>
                            <input type="text" name="pick_complete_bar_orders" class="form-control"
                                   id="pick_complete_bar_orders" placeholder="條" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cut_complete_dozen_orders">撿巾員完成數量(打)</label>
                            <input type="text" class="form-control" id="pick_complete_dozen_orders"
                                   name="pick_complete_dozen_orders" placeholder="打" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pick_cloth_emp">撿巾員</label>
                        <input type="text" name="pick_cloth_emp" class="form-control" id="pick_cloth_emp"
                               placeholder="撿巾員">
                    </div>
                    <div class="form-group">
                        <label for="date">日期</label>
                        <input type="text" name="date" class="form-control" id="date" placeholder="日期">
                    </div>
                    <div style="" class="column">

                        <button type="button" class="btn_add form-control btn btn-secondary rounded "
                                data-toggle="modal" data-target="#FoldHeadModal">
                            回報
                        </button>

                        {{--                        <button style="width: 100px;" type="submit"--}}
                        {{--                                class="btn_add form-control btn btn-secondary rounded mx-3">--}}
                        {{--                            確認--}}
                        {{--                        </button>--}}
                    </div>
                    <input type="text" name="title" style="display: none" value="{{$job_title->title}}"
                           class="form-control" id="title">
                </form>
                <div class="modal fade" id="FoldHeadModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">折頭回報</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <td>訂單數量</td>
                                        <td>{{(round($job_ticket->order/12-0.5)).'打'.($job_ticket->order%12).'條'}}</td>
                                    </tr>
                                    <td>折頭已回報</td>
                                    @if($foldHeadReports->count())
                                        <td>{{(round($sumFoldHeadReports/12-0.5)).'打'.($sumFoldHeadReports%12).'條'}}</td>
                                        {{--                                                <td>{{$sumFoldHeadReports}}</td>--}}

                                    @else
                                        <td>尚未回報</td>
                                    @endif
                                </table>
                                {{--                                        <tr>--}}
                                {{--                                            <td>訂單數量</td>--}}
                                {{--                                            <td>{{$job_ticket->order}}</td>--}}
                                {{--                                        </tr>--}}
                                {{--                                        <tr>--}}
                                {{--                                            <td>折頭已回報</td>--}}
                                {{--                                            <td>{{$sumFoldHeadReports}}</td>--}}
                                {{--                                        </tr>--}}
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button style="width: 100px;" type="submit" --}}
                                        class="btn_add form-control btn btn-secondary rounded mx-3">
                                    確認
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <script>
            const d = new Date()
            const date = document.getElementById("date");
            date.value = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
        </script>
    </div>



@endsection
