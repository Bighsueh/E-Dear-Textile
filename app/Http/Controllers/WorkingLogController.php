<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkingLogController extends Controller
{
    public function get_working_log_page(Request $request)
    {
        try {
            $employee_id = $request->employee_id;
            $employee_name = DB::table('users')
                ->where('id', $employee_id)
                ->first()->name;
            $data = [
                'employee_id' => $employee_id,
                'employee_name' => $employee_name
            ];
            return view('pages.workingLog.WorkingLogList', compact('data',$data));
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
