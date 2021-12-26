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

            return view('pages.workingLog.WorkingLogList', compact('data'));
        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function export_excel(Request $request)
    {
        return Excel::download(new JobReportExport($request->employee_id, $request->search_parameter), $request->employee_name . '.xlsx');
    }

    public function get_working_log_data(Request $request)
    {
        $search_parameter = null;
        if ($request->get('search_parameter') !== $search_parameter) {
            $search_parameter = $request->get('search_parameter');
        }
        $user_id = $request->get('user_id');

        $data = DB::table('job_reports')
            ->join('job_tickets', 'job_tickets.id', '=', 'job_reports.ticket_id');

        if ($search_parameter) {
            $data = $data->where(function ($query) use ($search_parameter){
                $query->orWhere('job_tickets.status', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.id', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.updated_at', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.employeeName', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.itemId', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.rollFunc', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.item', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_reports.quantity', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_reports.unit', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_reports.action', 'like binary', '%' . $search_parameter . '%');
            });
        }
        $data = $data->where('job_reports.operator', '=', $user_id)->get();
        return $data;

    }
}
