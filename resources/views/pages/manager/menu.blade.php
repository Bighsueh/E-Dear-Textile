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
                <form action="{{Route('get_result')}}" method="POST">
                    @csrf
                    <tr>
                        <td>
                            {{$job_ticket->employeeName}}
                        </td>
                        <td>
                            <a href="{{Route('get_list',$job_ticket->id)}}"
                               style="text-decoration: none; color: black;">{{$job_ticket->id}}</a>
                            <input type="text" name="ticket_id" style="display: none" class="form-control" value="{{$job_ticket->id}}"/>
                        </td>
                        <td>
                            {{$job_ticket->itemId}}
                        </td>
                        <td>
                            {{(round($job_ticket->order/12-0.5)).'打'.($job_ticket->order%12)."條"}}
                        </td>
                        <td>
                            <button type="submit" class="btn btn-secondary">結果</button>
                        </td>
                        <td>
                            {{$job_ticket->status}}
                        </td>
                        <td>

                        </td>
                    </tr>
                </form>
            @endforeach
            </tbody>

        </table>

    </div>



@endsection
