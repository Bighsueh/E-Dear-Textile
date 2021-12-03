<table>
    <thead>
    <tr>
        <th>#</th>
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
        @foreach($data as $row)
            <tr>
                <td>#</td>
                <td>{{ $row->type }}</td>
                <td>{{ $row->ticket_id }}</td>
                <td>{{ $row->created_at }}</td>
                <td>{{ $row->customer_name }}</td>
                <td>{{ $row->stock_id }}</td>
                <td>-</td>
                <td>{{ $row->num }}</td>
                <td>{{ $row->unit }}</td>
                <td>{{ $row->unit_price }}</td>
                <td>{{ $row->total }}</td>
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
