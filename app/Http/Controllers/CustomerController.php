<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function get_customer_page()
    {
        return view('pages.customer.customerMenu');
    }

    //判斷顧客是否存在
    public function confirm_customer(Request $request)
    {
        try {
            $customer_name = $request->customer_name;

            $customer = DB::table('job_tickets')
                ->where('employeeName', 'like', '%' . $customer_name . '%')
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
        $search_parameter = null;
        if ($request->search_parameter) {
            $search_parameter = $request->search_parameter;
        }

        try {
            $customer_name = $request->session()->get('user_id');
            $data = DB::table('job_tickets');


            $data = $data->where(function ($query) use ($search_parameter) {
                $query->orWhere('id', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('itemId', 'like binary', '%' . $search_parameter . '%');
            });

            $data = $data->where('employeeName', $customer_name)->get();
            return $data;
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
