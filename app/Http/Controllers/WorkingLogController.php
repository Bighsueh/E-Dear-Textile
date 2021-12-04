<?php

namespace App\Http\Controllers;

use App\Exports\JobReportExport;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

    public function get_working_log_data(Request $request)
    {
        $search_parameter = null;
        if ($request->search_parameter !== $search_parameter) {
            $search_parameter = $request->search_parameter;
        }

        $user_id = $request->user_id;

        $data = DB::table('job_reports')
            ->where('operator', $user_id)
            ->join('job_tickets', 'job_tickets.id', '=', 'job_reports.ticket_id')
            ->where('job_tickets.status', '出貨')
            ->orWhere('job_tickets.status', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.id', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.updated_at', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.employeeName', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.itemId', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.rollFunc', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.item', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_reports.quantity', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_reports.unit', 'like', '%' . $search_parameter . '%')
            ->get();
        return $data;

    }
}
