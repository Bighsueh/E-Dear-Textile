@extends('layouts.masters.manager')
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
                <th>狀態</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($job_tickets as $job_ticket)
                <tr>
                    <td>
                        {{$job_ticket->employeeName}}
                    </td>
                    <td>
                        <a href="{{Route('get_list',$job_ticket->id)}}" style="text-decoration: none; color: black;">{{$job_ticket->id}}</a>
                    </td>
                    <td>
                        {{$job_ticket->item}}
                    </td>
                    <td>
                        {{$job_ticket->order.'打'}}
                    </td>
                    <td>
                        {{--結果還沒帶值--}}
                        <button type="button" class="btn btn-secondary">結果</button>
                    </td>
                    <td>
                        {{$job_ticket->status}}
                    </td>
                    <td>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#QRcodeModal-{{$job_ticket->id}}">
                            QR Code
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="QRcodeModal-{{$job_ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header ">
                                            <h5 class="modal-title" id="exampleModalLabel" style="">{{$job_ticket->employeeName}}</h5>
{{--                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                <span aria-hidden="true">&times;</span>--}}
{{--                                            </button>--}}
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
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </td>
                </tr>
            @endforeach
            </tbody>

        </table>

    </div>



@endsection
