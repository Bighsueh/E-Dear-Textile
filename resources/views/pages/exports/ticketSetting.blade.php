<table>
    <thead>
    <tr>
        <th>顧客名稱</th>
        <th>貨號</th>
        <th>顏色</th>
        <th>洗標</th>
        <th>品項</th>
        <th>漂染廠</th>
        <th>色線</th>
        <th>滾邊方式</th>
        <th>備註</th>
        <th>訂單狀態</th>
    </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{$row->customer_name}}</td>
                <td>{{$row->item_no}}</td>
                <td>{{$row->color}}</td>
                <td>{{$row->wash_tag}}</td>
                <td>{{$row->item}}</td>
                <td>{{$row->blenching_and_dyeing_factory}}</td>
                <td>{{$row->color_thread}}</td>
                <td>{{$row->piping_method}}</td>
                <td>{{$row->remark}}</td>
                <td>{{$row->ticket_status}}</td>
            </tr>
        @endforeach
    </tbody>
</table>