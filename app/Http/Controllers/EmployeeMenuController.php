<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EmployeeMenuController extends Controller
{
    public function get_employee_menu()
    {
        // 派遣單查詢,join job_titles 檢查權限 增加一行where指令(不確定是否需要)
        $job_tickets = DB::table('job_tickets')
            ->join('job_titles', 'job_tickets.id', "=", 'job_titles.ticket_id')
            ->where('job_titles.authorized_person',session()->get('user_id'))
            ->get();

        //重置Session狀態
        Session::forget('qr_code_status');
        Session::forget('ticket_info');

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
