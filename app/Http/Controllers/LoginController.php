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
        if($request->session()->has('level')){
//            Session::forget('level');
            Session::flush();
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

            Session::put('user_id', $account_info->user_id);
            // use get_menu_page function to check level
            return $this->get_menu_page($request);

//            return page right here
        } catch (Exception $exception) {
            return redirect()->route('get_login');
        }
    }

    public function get_menu_page(Request $request)
    {

//            get session level
            $level = $request->session()->get('level');
            if ($level === 'manager') {
//                return 幹部 page
                return redirect()->route('get_menu');
            }
            if ($level === 'employee') {
//                return 員工 page
                return redirect()->route('get_employee_menu');
            }

    }
}
