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

    public function create_user_data(Request $request)
    {
        try {
            $create_level = $request->create_level;
            $create_name = $request->create_name;
            $create_account = $request->create_account;
            $create_password = $request->create_password;

            $max_of_id = DB::table('users')->groupBy('user_id')->count();
            DB::table('users')->insert([
                "user_id" => ($max_of_id) + 1,
                "name" => $create_name,
                "account" => $create_account,
                "password" => $create_password,
                "level" => $create_level
            ]);
            return 'success';
        } catch (Exception $exception) {
            return $exception;
        }

    }
}
