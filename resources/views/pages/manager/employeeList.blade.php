@extends('layouts.masters.manager')
@section('content')
    <div class="container ">
        <div class="row form-inline form-group">
            <div class="input-group col-sm-8 col-8">
                <input type="text" class="form-control" placeholder="搜尋員工關鍵字" aria-label=""
                       aria-describedby="basic-addon1" name="search_parameter" id="search_parameter">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="button" id="btn_search">搜尋</button>
                </div>
            </div>
            <div class="col-sm-4 col-4 row">
                <button type="button" class="btn btn-outline-secondary mx-1 col col-sm text-center"
                        data-toggle="modal" data-target="#CreateUserModal">新增員工
                </button>
                <button type="button" class="btn btn-outline-secondary mx-1 col col-sm text-center" id="btn_setting">
                    員工設定
                </button>
            </div>

    <div style="display: none">
        {{$i=1}}
    </div>
    <div style="display: flex" class="container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>職位</th>
                <th>姓名</th>
                <th>工作明細</th>
            </tr>
            </thead>
            <tbody id="tbody">
            </tbody>

        </table>

    </div>
    <script>
        update_data();

        function update_data() {
            let url = '{{route('get_employee_data')}}';
            $.ajax({
                url: url,
                method: 'GET',
                data: '',
                success: function (res) {
                    console.log(res)
                    let thread = 1;
                    if (res.length > 0) {
                        res.forEach(function (row) {
                            let row_thread = "<td>" + (thread++) + "</td>";
                            let row_level = "<td>" + row["level"] + "</td>";
                            let row_name = "<td>" + row["name"] + "</td>";
                            let row_function = "<td><a class='btn btn-secondary text-white'>查看</a></td>";

                            $("tbody").append(
                                "<tr>"+ row_thread + row_level + row_name + row_function + "</tr>"
                            );
                        });
                    }
                    if (res.length === 0) {
                        $("tbody").append(
                            "<tr><td colspan='4' class='text-center'>查無資料</td></tr>"
                        );
                    }


                },
                error: function (err) {
                    console.log(err);
                }
            })

        }



    </script>


@endsection
