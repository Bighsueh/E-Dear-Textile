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
                        <a href="{{Route('get_list',$job_ticket->id)}}"
                           style="text-decoration: none; color: black;">{{$job_ticket->id}}</a>
                    </td>
                    <td>
                        {{$job_ticket->item}}
                    </td>K
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
                        K
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

    </div>



@endsection
