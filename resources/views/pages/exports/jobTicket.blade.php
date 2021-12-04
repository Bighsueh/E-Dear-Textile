<table>
    <thead>
    <tr>
        <th>客戶名稱</th>
        <th>派遣單編號</th>
        <th>貨號</th>
        <th>訂單數量</th>
        <th>貨別</th>
        <th>日期</th>
    </tr>
    </thead>
    <tbody>
    @if(count($data)>=1)
        @foreach($data as $row)
            <tr>
                <td>{{ $row->employeeName }}</td>
                <td>{{ $row->id }}</td>
                <td>{{ $row->itemId }}</td>
                <td>{{ $row->order }}</td>
                <td>{{ $row->status }}</td>
                <td>{{ $row->created_at }}</td>
            </tr>
        @endforeach
    @endif
    @if(count($data)==0)
        <tr>
            <td colspan="6">無資料</td>
        </tr>
    @endif
    </tbody>
</table>
