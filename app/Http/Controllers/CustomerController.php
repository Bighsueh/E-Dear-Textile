<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function confirm_customer_name(Request $request)
    {
        try {
            $customer_name = $request->customer_name;

            $customer = DB::table('job_tickets')
                ->where('employeeName', $customer_name)
                ->first();

            if(count($customer)>0) {
                Session::put('user_id', $customer->name);
                return 'exist';
            }
            if (count($customer) == 0) {
                return 'not exist';
            }



        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function get_cumstomer_data(Request $request)
    {
        try {

        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
