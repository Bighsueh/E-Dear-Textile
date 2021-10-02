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
            </tr>
            </thead>
            <tbody>
            @foreach($job_tickets as $job_ticket)
                <tr>
                    <td>
                        {{$job_ticket->employeeName}}
                    </td>
                    <td>
                        {{$job_ticket->id}}
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
                </tr>
            @endforeach
            </tbody>

        </table>

    </div>
    <div class=" footer text-center text-lg-start bg-dark text-muted fixed-bottom">
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">

        </div>
    </div>

@endsection
