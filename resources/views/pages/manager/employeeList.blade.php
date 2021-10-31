
@extends('layouts.masters.manager')
@section('content')

    <div style="display: flex" class="container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>職位</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $users)
                <tr>
                    <td>
                        {{$users->id}}
                    </td>
                    <td>
                        {{$users->name}}
                    </td>
                    <td>
                        {{$users->level}}
                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>

    </div>



@endsection
