@extends('layouts.masters.employee')

@section('content')
    <div style="display: flex" class="container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>客戶名稱</th>
                <th>派遣單編號</th>
                <th>授權人</th>
                <th>貨號</th>
                <th>訂單數量</th>
                <th>回報</th>
            </tr>
            </thead>
            <tbody>
            <form action="{{Route('post_employee_report')}}" method="POST">
                @foreach($job_tickets as $job_ticket)
                    <tr>
                        <td class="employee-name">
                            {{$job_ticket->employeeName}}
                        </td>
                        <td class="ticket-id">
                            <a class="ticket-id text-primary" href="{{Route('get_employee_list',$job_ticket->ticket_id)}}"
                               >{{$job_ticket->ticket_id}}</a>
                            <input type="text" name="ticket_id" style="display: none" class="form-control"
                                   value="{{$job_ticket->ticket_id}}"/>
                        </td>
                        <td>
                            {{$job_ticket->authorizer}}
                            <input type="text" name="authorizer" style="display: none" class="form-control"
                                   value="{{$job_ticket->authorizer}}"/>
                        </td>
                        <td>
                            {{$job_ticket->itemId}}
                        </td>
                        <td>
                            {{(round($job_ticket->order/12-0.5)).'打'.($job_ticket->order%12)."條"}}
                        </td>
                        <td>
                            @csrf
                            <button type="button" class="btn btn-secondary btn-report">選填</button>
                            @if($job_ticket->title === '滾邊')
                                <button type="button" class="btn btn-secondary btn-open-qrcode-modal">
                                    剪巾回報
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </form>
            </tbody>
        </table>
    </div>
    @include('pages.employee.QrCodeModal')
    @include('pages.employee.TaskReportModal')

    <script>
        function close_modal() {
            $(".modal").modal('hide');
        }

        $(".close-modal").click(function () {
            close_modal();
        })
        $('.btn-report').click(function () {
            open_report_modal();
        })
    </script>
@endsection
