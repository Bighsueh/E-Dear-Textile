<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeMenuController extends Controller
{
    public function get_employee_menu()
    {
        // 派遣單查詢,join job_titles 檢查權限
        $job_tickets = DB::table('job_tickets')
            ->join('job_titles', 'job_tickets.id', "=", 'job_titles.ticket_id')
            ->get();

        return view('pages.employee.employeeMenu',compact('job_tickets',$job_tickets));
    }

    public function get_employee_list($id)
    {
        $job_tickets = DB::table('job_tickets')->where('id',$id)->first();
        return view('pages.employee.employeeList',compact('job_tickets',$job_tickets));
    }

    public function post_employee_report(Request $request)
    {
        $query = $request->except('_token');
//        dd($request);
        $position = $query['report_rd'];
        $job_tickets = DB::table('job_tickets')->where('id',$query['report_ticket_id'])->first();
//        dd($job_tickets);
        return view('pages.employee.employeeReport',compact('job_tickets','position'));
    }

    public function post_create_employee_report(Request $request)
    {
        dd($request);
    }
}
