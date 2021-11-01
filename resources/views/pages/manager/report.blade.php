@extends('layouts.masters.manager')
@section('content')
    <div class="container">
        <table class="table">
            <tr>
                <td>客戶名稱</td>
                <td>{{$job_ticket->employeeName}}</td>
            </tr>
            <tr>
                <td>派遣單編號</td>
                <td>{{$job_ticket->id}}</td>
            </tr>
            <tr>
                <td>貨號</td>
                <td>{{$job_ticket->itemId}}</td>
            </tr>
            <tr>
                <td>色線</td>
                <td>{{$job_ticket->colorId."-".$job_ticket->colorId2}}</td>
            </tr>
            <tr>
                <td>洗標</td>
                <td>{{$job_ticket->wash}}</td>
            </tr>
            <tr>
                <td>訂單數量</td>
                <td>{{$job_ticket->order}}</td>
            </tr>
            <tr>
                <td>剪巾 回報</td>
                @if($reports->count())
                    <td><a href="{{Route('get_resultDetail',["cut",$job_ticket->id])}}"
                           style="text-decoration: none; color: black;">{{$sumReports}}</a></td>
                @else
                    <td>向未回報</td>
                @endif
            </tr>
            <tr>
                <td>折頭 回報</td>
                @if($foldHeadReports->count())
                    <td><a href="{{Route('get_resultDetail',["foldHead",$job_ticket->id])}}"
                           style="text-decoration: none; color: black;">{{$sumFoldHeadReports}}</a></td>
                @else
                    <td>向未回報</td>
                @endif
            </tr>
        </table>
    </div>


@endsection
