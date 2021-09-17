<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;

class LoginController extends Controller
{
    public function get_login_page(Request $request)
    {
        //判斷是否已登入，若有則回傳list page
        if ($request->session()->has('level')){
            $level = $request->session()->has('level');

            if ($level === 'manager') {
//                return 幹部 page
            }
            if ($level === 'employee') {
//                return 員工 page
            }

        }

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
            Session::put('level', $level);

            //go to menu page and need to add condition to check level
            return view('pages.login.menu');

//            return page right here
        } catch (Exception $exception) {
            return redirect()->route('get_login');
        }
    }

    public function post_menu()
    {

    }
}
