@extends('layouts.masters.manager')
@section('content')

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
