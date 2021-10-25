@extends('layouts.masters.employee')

@section('content')
    <div style="display: flex" class="container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>客戶名稱</th>
                <th>派遣單編號</th>
                <th>貨號</th>
                <th>訂單數量</th>
                <th>回報</th>
            </tr>
            </thead>
            <tbody>
            @foreach($job_tickets as $job_ticket)
                <tr>
                    <td>
                        {{$job_ticket->employeeName}}
                    </td>
                    <td>
                        <a href="{{Route('get_employee_list',$job_ticket->id)}}" style="text-decoration: none; color: black;">{{$job_ticket->id}}</a>
                    </td>
                    <td>
                        {{$job_ticket->item}}
                    </td>
                    <td>
                        {{$job_ticket->order.'打'}}
                    </td>
                    <td>
                        <form class="form" method="POST" action="{{route('post_employee_report')}}">
                            @csrf
                            <!-- 回報的Modal -->
                            <div class="modal fade" id="report{{$job_ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="reportModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <!-- head -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="resultModal">選擇回報方式</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- body -->
                                        <input type="hidden" value="{{$job_ticket->id}}" name="report_ticket_id">
                                        <div class="modal-body">
                                            {{$job_ticket->id}}
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="report_rd" id="report_rd1" value="1" >
                                                <label class="form-check-label" for="report_rd1">
                                                    剪巾回報
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="report_rd" id="report_rd2"  value="2" checked>
                                                <label class="form-check-label" for="report_rd2">
                                                    折頭回報
                                                </label>
                                            </div>
                                        </div>
                                        <!-- footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                                            <button type="submit" class="btn btn-primary">進入回報</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{--選填還沒帶值--}}
                        <button type="button" data-toggle="modal" data-target="#report{{$job_ticket->id}}" class="btn btn-secondary">選填</button>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#QRcodeModal-{{$job_ticket->id}}">
                            QR Code
                        </button>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>

    </div>
    @foreach($job_tickets as $job_ticket)
        <!-- Modal -->
        <div class="modal fade" id="QRcodeModal-{{$job_ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title" id="exampleModalLabel" style="">{{$job_ticket->employeeName}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div id="qrcode-{{$job_ticket->id}}"></div>
                            <script>
                                $('#qrcode-{{$job_ticket->id}}').qrcode("http://140.130.36.85/"+ {{$job_ticket->id}});
                            </script>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{--                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endsection
