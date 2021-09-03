<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
            $account_info = $users_table
                ->where('account', $employee_id)
                ->where('password', $employee_password)
                ->first();

//            帳戶不存在
            if ($account_info == null) {
                return redirect()->route('get_login');
            };

//            使用者權限判斷
            $level = $account_info->level;
            switch ($level) {
                case 'admin':
                    Session::put('level', 'admin');
                case 'manager':
                    Session::put('level', 'manager');
                case 'employee':
                    Session::put('level', 'employee');
            }

            dd($level);
//            return page right here
        } catch (Exception $exception) {
            return redirect()->route('get_login');
        }
    }
}
