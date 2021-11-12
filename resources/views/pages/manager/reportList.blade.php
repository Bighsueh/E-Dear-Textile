@extends('layouts.masters.manager')
@section('content')
    <div class="container">
        @if($report == 'piping')
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">作業員</th>
                        <th scope="col">數量</th>
                        <th scope="col">完成時間</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($queries as $query)
                            <tr>
                                <td>{{$query->Piping}}</td>
                                <td>{{(round($query->piping_order/12-0.5)).'打'.($query->piping_order%12)."條"}}</td>
                                <td>{{$query->updated_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        @elseif($report == 'cut')
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">作業員</th>
                    <th scope="col">數量</th>
                    <th scope="col">滾邊員</th>
                    <th scope="col">完成時間</th>
                </tr>
                </thead>
                <tbody>
                @foreach($queries as $query)
                    <tr>
                        <td>{{$query->user_id}}</td>
                        <td>{{(round($query->cut_order/12-0.5)).'打'.($query->cut_order%12)."條"}}</td>
                        <td>{{$query->Piping}}</td>
                        <td>{{$query->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @elseif($report == 'foldHead')
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">作業員</th>
                    <th scope="col">數量</th>
                    <th scope="col">撿巾員</th>
                    <th scope="col">完成時間</th>
                </tr>
                </thead>
                <tbody>
                @foreach($queries as $query)
                    <tr>
                        <td>{{$query->user_id}}</td>
                        <td>{{(round($query->foldHead_order/12-0.5)).'打'.($query->foldHead_order%12)."條"}}</td>
                        <td>{{$query->pickTower}}</td>
                        <td>{{$query->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @elseif($report == 'pickTower')
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">作業員</th>
                    <th scope="col">數量</th>
                    <th scope="col">完成時間</th>
                </tr>
                </thead>
                <tbody>
                @foreach($queries as $query)
                    <tr>
                        <td>{{$query->pickTower}}</td>
                        <td>{{(round($query->pickTower_order/12-0.5)).'打'.($query->pickTower_order%12)."條"}}</td>
                        <td>{{$query->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
            <button type="button"
                    class="btn_print form-control btn btn-secondary rounded mx-3" onclick="window.print()">列印
            </button>
    </div>
@endsection
