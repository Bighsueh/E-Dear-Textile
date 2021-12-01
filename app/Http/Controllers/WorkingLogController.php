<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkingLogController extends Controller
{
    public function get_working_log_page(Request $request)
    {
        try{
            $employee_id = $request->employee_id;
            $data = DB::table('job_titles')
                ->join('job_reports', 'job_titles.id', '=', 'job_reports.ticket_id')
                ->where('job_reports.operator', $employee_id)
                ->get();
            return view('pages.workingLog.WorkingLogList',$data);
        }catch (Exception $exception){
            return $exception;
        }
    }
}
