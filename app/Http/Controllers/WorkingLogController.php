<?php

namespace App\Http\Controllers;

use App\Exports\JobReportExport;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
            return view('pages.workingLog.WorkingLogList', compact('data', $data));
        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function export_excel(Request $request)
    {
        return Excel::download(new JobReportExport($request->employee_id, $request->search_parameter), $request->employee_name.'.xlsx');
    }
}
