<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class LoginController extends Controller
{
    public function get_login_page()
    {
        return view('pages.login.login');
    }

    public function post_login(Request $request)
    {
        $employee_id = $request->input('employee_id');
        $employee_password = $request->input('employee_password');

        $users_table = DB::table('users')->get();
        try {
            $check_account = $users_table
                ->where('account', $employee_id)
                ->where('password', $employee_password)
                ->first();
            if ($check_account === null) {
                return redirect()->route('get_login');
            };
            dd($check_account);
        } catch (Exception $exception) {
            return redirect()->route('get_login');
        }
    }
}
