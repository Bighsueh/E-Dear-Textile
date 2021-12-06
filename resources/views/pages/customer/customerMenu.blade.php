@extends('layouts.masters.customer')

@section('content')
    <div style="display: flex" class="container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>客戶名稱</th>
                <th>派遣單編號</th>
                <th>貨號</th>
                <th>訂單數量</th>
                <th>目前狀態</th>
            </tr>
            </thead>
            <tbody class="tbody">
            </tbody>
        </table>
    </div>
@include('pages.customer.ConfirmIdentityModal')

@endsection
