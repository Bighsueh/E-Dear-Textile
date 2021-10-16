@extends('layouts.masters.employee')

@section('content')
    <div style="display: flex" class="container">
        {{--好醜 希望有人可以美化--}}
        <table class="table">
            <tr>
                <td>客戶名稱</td>
                <td>{{$job_tickets->employeeName}}</td>
            </tr>
            <tr>
                <td>派遣單編號</td>
                <td>{{$job_tickets->id}}</td>
            </tr>
            <tr>
                <td>貨號</td>
                <td>{{$job_tickets->itemId}}</td>
            </tr>
            <tr>
                <td>色線</td>
                <td>{{$job_tickets->color}}</td>
            </tr>
            <tr>
                <td>洗標</td>
                <td>{{$job_tickets->wash}}</td>
            </tr>
            <tr>
                <td>訂單數量</td>
                <td>{{$job_tickets->order}}</td>
            </tr>
        </table>

    </div>


@endsection
