@extends('layouts.masters.manager')
@section('content')

    <div class="container">
        <div class="row form-inline form-group">
            <div class="input-group col-sm-8 col-8">
                <input type="text" class="form-control" placeholder="搜尋貨單關鍵字" aria-label=""
                       aria-describedby="basic-addon1" name="search_parameter" id="search_parameter">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button" id="btn_search">搜尋</button>
                </div>
            </div>
            <div class="col-sm-4 col-4 row">
                <div class="form-control col col-sm text-center">
                    員工：{{$data['employee_name']}}
                </div>
                <button type="button" class="btn btn-outline-secondary mx-1 col col-sm text-center"
                        id="btn_export_excel">
                    匯出報表
                </button>
            </div>
            <input type="hidden" id="employee_id" value="{{$data["employee_id"]}}"/>

        </div>

    </div>
    <div style="" class="container-fluid px-5">
        <table class="table">
            <thead class="thead-dark">
            <tr class="row">
                <th class="col-sm-1">#</th>
                <th class="col-sm">貨別</th>
                <th class="col-sm">貨單編號</th>
                <th class="col-sm">貨單日期</th>
                <th class="col-sm">客戶簡稱</th>
                <th class="col-sm">貨品編號</th>
                <th class="col-sm">品名規格</th>
                <th class="col-sm">數量</th>
                <th class="col-sm">單位</th>
                <th class="col-sm">單價</th>
                <th class="col-sm">金額</th>

            </tr>
            </thead>
            <tbody id="tbody">
            </tbody>

        </table>

    </div>
    <script>
        if (!navigator.userAgent.toLowerCase().includes("windows")) {
            window.alert('此頁面建議使用電腦觀看，已獲得最佳使用體驗。');
        }

        $("#btn_export_excel").click(function () {
            window.location.href = "{{route('working_job_export_excel')}}";
        })
    </script>
@endsection
