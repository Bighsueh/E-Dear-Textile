<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;

class UserController extends Controller
{
    public function get_user_page()
    {
        return view('pages.users.userList');
    }

    public function get_user_data(Request $request)
    {
        $search_parameter = null;
        if ($request->search_parameter !== $search_parameter) {
            $search_parameter = $request->search_parameter;
        }
        if ($search_parameter == "幹部") {
            $search_parameter = "manager";
        }
        if ($search_parameter == "員工") {
            $search_parameter = "employee";

        }

        //取得員工列表
        $data = DB::table('users')
            ->select('id', 'name', 'level')
            ->orwhere('name', 'like', '%' . $search_parameter . '%')
            ->orwhere('level', 'like', '%' . $search_parameter . '%')
            ->get();

        foreach ($data as $row) {
            if ($row->level == "admin") {
                $row->level = "系統管理員";
            }
            if ($row->level == "manager") {
                $row->level = "幹部";
            }
            if ($row->level == "employee") {
                $row->level = "員工";
            }
        }
        return $data;
    }

    //新增使用者api
    public function create_user_data(Request $request)
    {
        try {
            $create_level = $request->create_level;
            $create_name = $request->create_name;
            $create_account = $request->create_account;
            $create_password = $request->create_password;

            DB::table('users')->insert([
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

    //read使用者api
    public function get_edit_data(Request $request)
    {
        try {
            $user_id = $request->user_id;
            $data = DB::table('users')->where('id', $user_id)->get();

            return $data;

        } catch (Exception $exception) {
            return $exception;
        }
    }

    //store使用者api
    public function store_edit_data(Request $request)
    {
        try {
            $edit_id = $request->edit_id;
            $edit_level = $request->edit_level;
            $edit_name = $request->edit_name;
            $edit_account = $request->edit_account;
            $edit_password = $request->edit_password;

            //系統管理員僅可更改密碼
            if ($edit_name === '系統管理員') {
                DB::table('users')
                    ->where('id', $edit_id)
                    ->update([
                        "password" => $edit_password,
                    ]);
                return 'success';
            }

            DB::table('users')
                ->where('id', $edit_id)
                ->update([
                    "name" => $edit_name,
                    "account" => $edit_account,
                    "password" => $edit_password,
                    "level" => $edit_level
                ]);
            return 'success';
        } catch (Exception $exception) {
            return $exception;
        }

    }

    //delete使用者api
    public function delete_edit_data(Request $request)
    {
        try {
            $user_id = $request->user_id;
            $is_admin = DB::table('users')
                ->where('id', $user_id)
                ->where('level', 'admin')
                ->get();

            if ($is_admin) {
                return "admin can't be delete";
            }
                DB::table('users')
                    ->where('id', $user_id)
                    ->delete();
            return 'success';
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
