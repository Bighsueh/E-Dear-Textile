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
//        dd($job_tickets);
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
        $user_id = $request->session()->get('user_id');
//        dd($user_id);
//        dd($request);
        $job_title = DB::table('job_titles')->select('title')->where('authorized_person', $user_id)->Where('ticket_id',$request->ticket_id)->orderBy('id','desc')->first();
//        dd($job_title);
        if($job_title->title == "剪巾" || $job_title->title == "折頭") {
            $job_tickets = DB::table('job_tickets')->where('id', $request->ticket_id)->get();
            $Pipings = DB::table('job_titles')->where('title', "滾邊")->Where('ticket_id', $request->ticket_id)->get();
//            dd($rolls);
            return view('pages.employee.employeeReport',compact('job_tickets','job_title','Pipings'));
        }
        else{
            return redirect()->route('get_employee_menu');
        }
    }

    public function post_create_employee_report(Request $request)
    {
//        dd($request);
        $query = $request->except('_token');
        DB::table('job_reports')->insert([
            'Piping'=>$query['Piping'],
            'ccntent'=>$query['complete_orders'],
            'user_id'=>$request->session()->get('user_id'),
            'ticket_id' => $query['ticket_id'],
            'created_at'=>$query['date'],
            'updated_at'=>$query['date'],
        ]);
        return redirect()->route('get_employee_menu');
    }
}
