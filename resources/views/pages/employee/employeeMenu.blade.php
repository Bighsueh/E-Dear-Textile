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
            <form action="{{Route('post_employee_report')}}" method="POST">
                @foreach($job_tickets as $job_ticket)
                        <tr>
                            <td>
                                {{$job_ticket->employeeName}}
                            </td>
                            <td>
                                <a href="{{Route('get_employee_list',$job_ticket->ticket_id)}}" style="text-decoration: none; color: black;">{{$job_ticket->ticket_id}}</a>
                                <input type="text" name="ticket_id" style="display: none" class="form-control" value="{{$job_ticket->ticket_id}}"/>
                            </td>
                            <td>
                                {{$job_ticket->itemId}}
                            </td>
                            <td>
                                {{$job_ticket->order.'打'}}
                            </td>
                            <td>

                                    @csrf
                                    <button type="submit" class="btn btn-secondary">選填</button>

                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#QRcodeModal-{{$job_ticket->id}}">
                                    QR Code
                                </button>
                            </td>
                        </tr>
                @endforeach
            </form>
            </tbody>

        </table>

    </div>
    @foreach($job_tickets as $job_ticket)
        <!-- Modal -->
        <div class="modal fade" id="QRcodeModal-{{$job_ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title" id="exampleModalLabel" style=""> 此QR Code僅供剪巾員進行掃描  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <br>
                            <div id="qrcode-{{$job_ticket->ticket_id}}"></div>
                            <script>
                                $('#qrcode-{{$job_ticket->ticket_id}}').qrcode("{{url('/afterScan/CutToPiping/')}}/{{$job_ticket->ticket_id}}/{{Illuminate\Support\Facades\Session::get('user_id')}}");
                            </script>
                        </div>
                    </div>
                    <div class="modal-footer">
                        廠商：{{$job_ticket->employeeName}}
                        {{--                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@endsection
