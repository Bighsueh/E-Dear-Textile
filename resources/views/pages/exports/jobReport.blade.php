<table>
    <thead>
    <tr>
        <th>#</th>
        <th>貨別</th>
        <th>工作類別</th>
        <th>貨單編號</th>
        <th>貨單日期</th>
        <th>客戶簡稱</th>
        <th>貨品編號</th>
        <th>品名規格</th>
        <th>數量</th>
        <th>單位</th>
        <th>單價</th>
        <th>金額</th>
    </tr>
    </thead>
    <tbody>
    @if(count($data)>=1)
        @foreach($data as $key => $row)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ $row->action }}</td>
                <td>{{ $row->status }}</td>
                <td>{{ $row->ticket_id }}</td>
                <td>{{ $row->updated_at }}</td>
                <td>{{ $row->employeeName }}</td>
                <td>{{ $row->itemId }}</td>
                <td>{{ $row->rollFunc . $row->item }}</td>
                <td>{{ $row->quantity }}</td>
                <td>{{ $row->unit }}</td>
                <td>-</td>
                <td>-</td>
            </tr>
        @endforeach
    @endif
    @if(count($data)==0)
        <tr>
            <td colspan="11">無資料</td>
        </tr>
    @endif
    </tbody>
</table>
