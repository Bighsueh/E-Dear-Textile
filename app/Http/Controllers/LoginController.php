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
        //Session flush
        Session::flush();
        //重新產生Session ID
        $request->session()->regenerate();
        $data = DB::table('users')->select('name', 'account')->get();
//        dd($data);

        return view('pages.login.login', compact('data', $data));
    }

    public function post_login(Request $request)
    {
        $account = $request->input('employee_account');
        $employee_password = $request->input('employee_password');
        $users_table = DB::table('users')->get();

        if ($account === '客戶') {
            Session::put('level', 'customer');
            return redirect()->route('get_customer_page');
        }

        try {
            $check_name = $users_table->where('name', $account)->first();
            if ($check_name) {
                $account = $check_name->account;
            }

            $account_info = $users_table
                ->where('account', $account)
                ->where('password', $employee_password)
                ->first();

//            帳戶不存在
            if ($account_info == null) {
                return redirect()->route('get_login');
            };

//            使用者權限判斷
            $level = $account_info->level;
            Session::put('level', $level);
            Session::put('user_id', $account_info->id);
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
