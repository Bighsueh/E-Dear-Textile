<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    //判斷顧客是否存在
    public function confirm_customer(Request $request)
    {
        try {
            $customer_name = $request->customer_name;

            $customer = DB::table('job_tickets')
                ->where('employeeName', $customer_name)
                ->first();
//            dd($customer);

            if ($customer !== null) {
                //判斷session是否存在，是則加入1
                Session::put('user_id', $customer->employeeName);
                Session::put('level', 'customer');
                return 'exist';
            }
            if ($customer === null) {
                return 'not exist';
            }


        } catch (Exception $exception) {
            return $exception;
        }
    }


    public function get_tickets_data(Request $request)
    {
        try {
            $customer_name = $request->session()->get('user_id');

            $data = DB::table('job_tickets')
                ->where('employeeName', $customer_name)
                ->get();
            return $data;
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
