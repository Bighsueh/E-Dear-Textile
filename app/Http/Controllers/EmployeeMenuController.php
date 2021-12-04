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
            ->where('job_tickets.status','=','排程中')
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

        $ticket_id = $request->except('_token');
        $job_ticket = DB::table('job_tickets')->where('id',$ticket_id)->first();
        $reports = DB::table('job_reports')->where('ticket_id',$ticket_id)->get();
        $foldHeadReports = DB::table('job_foldhead_reports')->where('ticket_id',$ticket_id)->get();

//        計算目前回報總數量
        if($reports->count())
        {
            $sumReports = DB::table('job_reports')->where('ticket_id', $ticket_id)->sum('cut_order');
            $sumPipReports = DB::table('job_reports')->where('ticket_id', $ticket_id)->sum('Piping_order');

        }
        if($foldHeadReports->count())
        {
            $sumFoldHeadReports = DB::table('job_foldhead_reports')->where('ticket_id', $ticket_id)->sum('foldHead_order');
            $sumPickReports = DB::table('job_foldhead_reports')->where('ticket_id', $ticket_id)->sum('pickTower_order');
//            dd($sumPickReports);
        }

        if($job_title->title == "剪巾"  ) {
            $job_tickets = DB::table('job_tickets')->where('id', $request->ticket_id)->get();
            $Pipings = DB::table('job_titles')->where('title', "滾邊")->Where('ticket_id', $request->ticket_id)->Where('authorized_person', $request->authorizer)->get();

//            dd($Pipings);
            return view('pages.employee.employeeReport',compact('job_tickets','job_title','Pipings','sumReports','sumPipReports','reports'));
        }
        elseif($job_title->title == "折頭"){
            $job_tickets = DB::table('job_tickets')->where('id', $request->ticket_id)->get();
//            dd($job_tickets);
            $foldHeads = DB::table('job_titles')->where('title', "折頭")->Where('ticket_id', $request->ticket_id)->get();
//            dd($foldHead);
            return view('pages.employee.employeeReport',compact('job_tickets','job_title','foldHeads','sumFoldHeadReports','sumPickReports','foldHeadReports'));
        }
        else{
            return redirect()->route('get_employee_menu');
        }
    }

    public function get_report_data(Request $request)
    {
        try{

            $user_id = Session::get('user_id');
            $ticket_report = DB::table('job_reports')
                ->where('ticket_id',1)
                ->where('operator',$user_id)
                ->get();

            if($request->action == '剪巾'){
                $piping_report = DB::table('job_reports')
                ->where('ticket_id',1)
                ->where('submit_by',$user_id)
                    ->where('action','滾邊')
                    ->get();

            }
            elseif($request->action == '折頭'){
                $piping_report = DB::table('job_reports')
                    ->where('ticket_id',1)
                    ->where('submit_by',$user_id)
                    ->where('action','撿巾')
                    ->get();
            }







        }catch(Exception $exception){
            return $exception;
        }
    }
    public function store_report_data(Request $request){
        try{
//            $ticket_id = $request->;


            return ;
        }catch (Exception $exception){
            return$exception;
        }
    }
    public function post_create_employee_report(Request $request)
    {
//        dd($request);
        $query = $request->except('_token');
//        dd($query['pick_complete_bar_orders']+$query['pick_complete_dozen_orders']*12);
        if($query['title'] == '剪巾')
        {
            DB::table('job_reports')->insert([
                'Piping'=>$query['Piping'],
                'piping_order'=>$query['cut_complete_bar_orders']+$query['cut_complete_dozen_orders']*12,
                'cut_order' => $query['cut_complete_bar_orders']+$query['cut_complete_dozen_orders']*12,
                'user_id'=>$request->session()->get('user_id'),
                'ticket_id' => $query['ticket_id'],
                'created_at'=>$query['date'],
                'updated_at'=>$query['date'],
            ]);
        }
        elseif ($query['title'] == '折頭'){
            DB::table('job_foldhead_reports')->insert([
                'pickTower'=>$query['pick_cloth_emp'],
                'foldHead_order'=>$query['complete_bar_orders']+$query['complete_dozen_orders']*12,
                'pickTower_order' => $query['pick_complete_bar_orders']+$query['pick_complete_dozen_orders']*12,
                'user_id'=>$request->session()->get('user_id'),
                'ticket_id' => $query['ticket_id'],
                'created_at'=>$query['date'],
                'updated_at'=>$query['date'],
            ]);
        }

        return redirect()->route('get_employee_menu');
    }
}
