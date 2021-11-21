<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class UserController extends Controller
{
    public function get_user_data(Request $request)
    {
        $search_parameter = null;
        if ($request->search_parameter !== $search_parameter) {
            $search_parameter = $request->search_parameter;
        }

        //取得員工列表
        $data = DB::table('users')
            ->select('user_id', 'name', 'level')
            ->where('name', 'like', '%' . $search_parameter . '%')
            ->orwhere('level', 'like', '%' . $search_parameter . '%')
            ->get();

        foreach ($data as $row) {
            if ($row->level == "manager") {
                $row->level = "幹部";
            }
            if ($row->level == "employee") {
                $row->level = "員工";
            }
        }
        return $data;
    }


}
