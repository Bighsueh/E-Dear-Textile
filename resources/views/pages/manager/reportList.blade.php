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
                                <td>{{$query->piping_order}}</td>
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
                        <td>{{$query->cut_order}}</td>
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
                        <td>{{$query->foldHead_order}}</td>
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
                        <td>{{$query->pickTower_order}}</td>
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
