@extends('layouts.masters.manager')
@section('content')
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
            <th class="text-center" scope="col">項目</th>
            <th class="text-center" scope="col">總數量</th>
            <th scope="col">作業員</th>
            <th scope="col">數量</th>
            </thead>
            <tbody>
            @if($report == 'cut')
                @for($i = 0; $i < $queries->count(); $i++)
                    @if($i == 0)
                        <tr>
                            <td style="vertical-align : middle;text-align:center;" rowspan="{{$queries->count()}}">滾邊</td>
                            <td style="vertical-align : middle;text-align:center;" rowspan="{{$queries->count()}}"><a href="{{Route('get_resultList',[$queries[$i]->ticket_id,'piping'])}}" style="text-decoration: none; color: black;">{{(round($sum2/12-0.5)).'打'.($sum2%12)."條"}}</a></td>
                            <td>{{$queries[$i]->Piping}}</td>
                            <td>{{(round($queries[$i]->piping_order/12-0.5)).'打'.($queries[$i]->piping_order%12)."條"}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{$queries[$i]->Piping}}</td>
                            <td>{{(round($queries[$i]->piping_order/12-0.5)).'打'.($queries[$i]->piping_order%12)."條"}}</td>
                        </tr>
                    @endif
                @endfor
                @for($i = 0; $i < $queries->count(); $i++)
                    @if($i == 0)
                        <tr>
                            <td style="vertical-align : middle;text-align:center;" rowspan="{{$queries->count()}}">剪巾</td>
                            <td style="vertical-align : middle;text-align:center;" rowspan="{{$queries->count()}}"><a href="{{Route('get_resultList',[$queries[$i]->ticket_id,'cut'])}}" style="text-decoration: none; color: black;">{{(round($sum1/12-0.5)).'打'.($sum1%12)."條"}}</a></td>
                            <td>{{$queries[$i]->user_id}}</td>
                            <td>{{(round($queries[$i]->cut_order/12-0.5)).'打'.($queries[$i]->cut_order%12)."條"}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{$queries[$i]->user_id}}</td>
                            <td>{{(round($queries[$i]->cut_order/12-0.5)).'打'.($queries[$i]->cut_order%12)."條"}}</td>
                        </tr>
                    @endif
                @endfor
            @elseif($report == 'foldHead')
                @for($i = 0; $i < $queries->count(); $i++)
                    @if($i == 0)
                        <tr>
                            <td style="vertical-align : middle;text-align:center;" rowspan="{{$queries->count()}}">折頭</td>
                            <td style="vertical-align : middle;text-align:center;" rowspan="{{$queries->count()}}"><a href="{{Route('get_resultList',[$queries[$i]->ticket_id,'foldHead'])}}" style="text-decoration: none; color: black;">{{(round($sum1/12-0.5)).'打'.($sum1%12)."條"}}</a></td>
                            <td>{{$queries[$i]->user_id}}</td>
                            <td>{{(round($queries[$i]->foldHead_order/12-0.5)).'打'.($queries[$i]->foldHead_order%12)."條"}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{$queries[$i]->user_id}}</td>
                            <td>{{(round($queries[$i]->foldHead_order/12-0.5)).'打'.($queries[$i]->foldHead_order%12)."條"}}</td>
                        </tr>
                    @endif
                @endfor
                @for($i = 0; $i < $queries->count(); $i++)
                    @if($i == 0)
                        <tr>
                            <td style="vertical-align : middle;text-align:center;" rowspan="{{$queries->count()}}">撿巾</td>
                            <td style="vertical-align : middle;text-align:center;" rowspan="{{$queries->count()}}"><a href="{{Route('get_resultList',[$queries[$i]->ticket_id,'pickTower'])}}" style="text-decoration: none; color: black;">{{(round($sum2/12-0.5)).'打'.($sum2%12)."條"}}</a></td>
                            <td>{{$queries[$i]->pickTower}}</td>
                            <td>{{(round($queries[$i]->pickTower_order/12-0.5)).'打'.($queries[$i]->pickTower_order%12)."條"}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{$queries[$i]->pickTower}}</td>
                            <td>{{(round($queries[$i]->pickTower_order/12-0.5)).'打'.($queries[$i]->pickTower_order%12)."條"}}</td>
                        </tr>
                    @endif
                @endfor
            @endif
            </tbody>
        </table>
    </div>


@endsection
