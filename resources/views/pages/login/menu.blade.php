@extends('layouts.masters.manager')
@section('content')
    <div style="display: flex" class="container">
        <div class="row justify-content-center">
            <h1 class="text-center mb-12 col-lg-12">選單</h1>
            @if($job_tickets)
                <table class="table text-center">
                    <thead class="thead-dark ">
                    <tr>
                        <th><h3>客戶名稱</h3></th>
                        <th><h3>派遣單編號</h3></th>
                        <th><h3>貨號</h3></th>
                        <th><h3>訂單數量</h3></th>
                        <th><h3>回報</h3></th>
                        <th><h3>狀態</h3></th>
                    </tr>
                    </thead>
                    @foreach($job_tickets as $job_ticket)
                    <tr>
                        <td>
                            <h2>{{$job_ticket->employeeName}}</h2>
                        </td>
                        <td>
                            <h2>{{$job_ticket->ticket_id}}</h2>
                        </td>
                        <td>
                            <h2>{{$job_ticket->item}}</h2>
                        </td>
                        <td>
                            <h2>{{$job_ticket->order.'打'}}</h2>
                        </td>
                        <td>
                        {{--結果還沒帶值--}}
                            <h2><button type="button" class="btn btn-lg btn-secondary">結果</button></h2>
                        </td>
                        <td>
                            <h2>排程中</h2>
                        </td>
                    </tr>
                    @endforeach
                </table>
            @else
                <table class="table text-center">
                    <thead class="thead-dark ">
                        <tr>
                            <th><h3>客戶名稱</h3></th>
                            <th><h3>派遣單編號</h3></th>
                            <th><h3>貨號</h3></th>
                            <th><h3>訂單數量</h3></th>
                            <th><h3>回報</h3></th>
                            <th><h3>狀態</h3></th>
                        </tr>
                    </thead>
                    <tr>
                        <td>
                            <h2>彩虹</h2>
                        </td>
                        <td>
                            <h2>1995123</h2>
                        </td>
                        <td>
                            <h2>1150</h2>
                        </td>
                        <td>
                            <h2>100打</h2>
                        </td>
                        <td>
                            <h2><button type="button" class="btn btn-lg btn-secondary">結果</button></h2>
                        </td>
                        <td>
                            <h2>排程中</h2>
                        </td>
                    </tr>
                </table>
            @endif
            <button type="button"  onclick="window.location='{{ url(route('get_addSheet')) }}'" class="btn_add form-control btn btn-secondary rounded px-3 mb-8">建立新單</button>
        </div>
    </div>
@endsection
