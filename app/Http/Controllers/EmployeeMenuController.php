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
            ->leftJoin('users','users.id','=','job_titles.authorized_person')
            ->where('job_titles.authorized_person', session()->get('user_id'))
            ->where('job_tickets.status', '=', '排程中')
            ->select('employeeName','ticket_id','authorizer','itemId','order','title','name')
            ->get();
        $title = DB::table('job_titles')->select('title')
            ->where('authorized_person',session()->get('user_id'))->first();
        //重置Session狀態
        Session::forget('qr_code_status');
        Session::forget('ticket_info');

        return view('pages.employee.employeeMenu', compact( 'job_tickets','title'));
    }

    public function get_employee_list($id)
    {
        $job_tickets = DB::table('job_tickets')->where('id', $id)->first();
        return view('pages.employee.employeeList', compact('job_tickets', $job_tickets));
    }

    public function post_employee_report(Request $request)
    {
        $user_id = $request->session()->get('user_id');

//        dd($user_id);
//        dd($request);
        $job_title = DB::table('job_titles')->select('title')->where('authorized_person', $user_id)->Where('ticket_id', $request->ticket_id)->orderBy('id', 'desc')->first();
//        dd($job_title);

        $ticket_id = $request->except('_token');
        $job_ticket = DB::table('job_tickets')->where('id', $ticket_id)->first();
        $reports = DB::table('job_reports')->where('ticket_id', $ticket_id)->get();
        $foldHeadReports = DB::table('job_foldhead_reports')->where('ticket_id', $ticket_id)->get();

//        計算目前回報總數量
        if ($reports->count()) {
            $sumReports = DB::table('job_reports')->where('ticket_id', $ticket_id)->sum('cut_order');
            $sumPipReports = DB::table('job_reports')->where('ticket_id', $ticket_id)->sum('Piping_order');

        }
        if ($foldHeadReports->count()) {
            $sumFoldHeadReports = DB::table('job_foldhead_reports')->where('ticket_id', $ticket_id)->sum('foldHead_order');
            $sumPickReports = DB::table('job_foldhead_reports')->where('ticket_id', $ticket_id)->sum('pickTower_order');
//            dd($sumPickReports);
        }

        if ($job_title->title == "剪巾") {
            $job_tickets = DB::table('job_tickets')->where('id', $request->ticket_id)->get();
            $Pipings = DB::table('job_titles')->where('title', "滾邊")->Where('ticket_id', $request->ticket_id)->Where('authorized_person', $request->authorizer)->get();

//            dd($Pipings);
            return view('pages.employee.employeeReport', compact('job_tickets', 'job_title', 'Pipings', 'sumReports', 'sumPipReports', 'reports'));
        } elseif ($job_title->title == "折頭") {
            $job_tickets = DB::table('job_tickets')->where('id', $request->ticket_id)->get();
//            dd($job_tickets);
            $foldHeads = DB::table('job_titles')->where('title', "折頭")->Where('ticket_id', $request->ticket_id)->get();
//            dd($foldHead);
            return view('pages.employee.employeeReport', compact('job_tickets', 'job_title', 'foldHeads', 'sumFoldHeadReports', 'sumPickReports', 'foldHeadReports'));
        } else {
            return redirect()->route('get_employee_menu');
        }
    }

    public function get_report_data(Request $request)
    {
        try {
            $result = [];
            $user_id = Session::get('user_id');
            //自己回報的
            $ticket_reports = DB::table('job_reports')
                ->where('ticket_id', $request->ticket_id)
                ->where('submit_by',$user_id)
                ->where('action',$request->action)
                ->join('job_tickets', 'job_reports.ticket_id', '=', 'job_tickets.id')
                ->join('users', 'users.id', '=', 'job_reports.operator')
                ->select(
                    'job_reports.operator', 'job_reports.quantity', 'job_reports.unit','job_reports.ticket_id','job_reports.updated_at',
                    'job_tickets.employeeName', 'job_tickets.color', 'job_tickets.wash', 'job_tickets.color_line',
                    'users.name','job_tickets.item'
                )
                ->get();
            if($ticket_reports->count()){
            }else{
                DB::table('job_reports')
                    ->insert([
                        'action' => $request->action,
                        'operator' => $user_id,
                        'ticket_id' => $request->ticket_id,
                        'quantity' => 0,
                        'unit' => 'one',
                        'submit_by' => $user_id,
                        'created_at'=> $request->created_at,
                        'updated_at' => null
                    ]);

                $ticket_reports = DB::table('job_reports')
                    ->where('ticket_id', $request->ticket_id)
                    ->where('submit_by',$user_id)
                    ->where('action',$request->action)
                    ->join('job_tickets', 'job_reports.ticket_id', '=', 'job_tickets.id')
                    ->join('users', 'users.id', '=', 'job_reports.operator')
                    ->select(
                        'job_reports.operator', 'job_reports.quantity', 'job_reports.unit','job_reports.ticket_id','job_reports.updated_at',
                        'job_tickets.employeeName', 'job_tickets.color', 'job_tickets.wash', 'job_tickets.color_line',
                        'users.name'
                    )
                    ->get();
            }
            if ($request->action == '剪巾') {
                //以回報滾邊
                $piping_reports = DB::table('job_reports')
                    ->where('ticket_id', $request->ticket_id)
                    ->where('submit_by', $user_id)
                    ->where('action', '滾邊')
                    ->select('job_reports.operator','job_reports.quantity','job_reports.unit')
                    ->get();
                //授權給自己的滾邊員
                $piping_members = DB::table('job_titles')
                    ->where('ticket_id', $request->ticket_id)
                    ->where('authorized_person', $user_id)
                    ->join('users','job_titles.authorizer','=','users.id')
                    ->select('users.name','users.id')
                    ->get();
                $result = [
                    "ticket_reports" => $ticket_reports,
                    "piping_reports" => $piping_reports,
                    "piping_members" => $piping_members
                ];
                return $result;
            } elseif ($request->action == '折頭') {
                //以回報撿巾
                $pick_report = DB::table('job_reports')
                    ->where('ticket_id', 1)
                    ->where('submit_by', $user_id)
                    ->where('action', '撿巾')
                    ->get();
                //自己授權的撿巾員
//                $picks_members = DB::table('job_titles')
//                    ->where('ticket_id', $request->ticket_id)
//                    ->where('authorizer', $user_id)
//                    ->join('users','job_titles.authorized_person','=','users.id')
//                    ->get();
                $picks_members = DB::table('users')
                    ->where('level', 'employee')
                    ->select('id','name')
                    ->get();

                $result = [
                    "ticket_reports" => $ticket_reports,
                    "pick_reports" => $pick_report,
                    "picks_members" => $picks_members
                ];
                return $result;


            }


        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function store_report_data(Request $request){
        try{
            $user_id = Session::get('user_id');

            //更新的日期好像沒進來
            // 滾邊/撿巾的回報
            if($request->action == '剪巾'){
                //滾邊 回報

                foreach ($request->piping_list as $piping_report ){
                    $piping = DB::table('job_reports')
                        ->where('ticket_id',$request->ticket_id)
                        ->where('operator',$piping_report[0])
                        ->where('action','滾邊')
                        ->get();

                    if($piping->count()){
                        DB::table('job_reports')
                            ->where('id',$piping[0]->id)
                            ->update([
                                'quantity'=>$piping_report[1],
                                'unit'=>$piping_report[2],
                                'updated_at'=>$request->updated_at
                            ]);
                    }
                    else{
                        DB::table('job_reports')
                            ->insert([
                                'action' => '滾邊',
                                'operator' => $piping_report[0],
                                'ticket_id' => $request->ticket_id,
                                'quantity' => $piping_report[1],
                                'unit' => $piping_report[2],
                                'submit_by' => $user_id,
                                'updated_at'=>$request->updated_at
                            ]);
                    }
                }
            }else{
                //撿巾 回報

                foreach ($request->piping_list as $piping_report ){

                    $piping = DB::table('job_reports')
                        ->where('ticket_id',$request->ticket_id)
                        ->where('operator',$piping_report[0])
                        ->where('action','撿巾')
                        ->get();

                    if($piping->count()){

                        DB::table('job_reports')
                            ->where('id',$piping[0]->id)
                            ->update([
                                'quantity' => $piping_report[1],
                                'unit' => $piping_report[2],
                                'updated_at' => $request->updated_at
                            ]);
                    }
                    else{

                        DB::table('job_reports')
                            ->insert([
                                'action' => '撿巾',
                                'operator' => $piping_report[0],
                                'ticket_id' => $request->ticket_id,
                                'quantity' => $piping_report[1],
                                'unit' => $piping_report[2],
                                'submit_by' => $user_id,
                                'updated_at'=>$request->updated_at
                            ]);
                    }
                }
            }

            // 剪巾/折頭 回報
            if($request->action == '剪巾'){
                //剪巾回報
                $submit_by = DB::table('job_reports')
                    ->where('ticket_id',$request->ticket_id)
                    ->where('operator',$user_id)
                    ->where('action','剪巾')
                    ->get();

                if($submit_by->count()){
                    DB::table('job_reports')
                        ->where('id',$submit_by[0]->id)
                        ->update([
                            'quantity'=>$request->operator_number,
                            'unit'=>$request->operator_unit,
                            'updated_at'=>$request->updated_at
                        ]);
                }
                else{
                    DB::table('job_reports')
                        ->insert([
                            'action' => '剪巾',
                            'operator' => $user_id,
                            'ticket_id' => $request->ticket_id,
                            'quantity' => $request->operator_number,
                            'unit' => $request->operator_unit,
                            'submit_by' => $user_id,
                            'updated_at'=>$request->updated_at
                        ]);
                }
            }else{
                //折頭回報
                $submit_by = DB::table('job_reports')
                    ->where('ticket_id',$request->ticket_id)
                    ->where('operator',$user_id)
                    ->where('action','折頭')
                    ->get();

                if($submit_by->count()){
                    DB::table('job_reports')
                        ->where('id',$submit_by[0]->id)
                        ->update([
                            'quantity'=>$request->operator_number,
                            'unit'=>$request->operator_unit,
                            'updated_at'=>$request->updated_at
                        ]);
                }
                else{
                    DB::table('job_reports')
                        ->insert([
                            'action' => '折頭',
                            'operator' => $user_id,
                            'ticket_id' => $request->ticket_id,
                            'quantity' => $request->operator_number,
                            'unit' => $request->operator_unit,
                            'submit_by' => $user_id,
                            'updated_at'=>$request->updated_at
                        ]);
                }
            }


            return 'success';
        }catch (Exception $exception){
            return$exception;
        }
    }

    public function post_create_employee_report(Request $request)
    {
//        dd($request);
        $query = $request->except('_token');
//        dd($query['pick_complete_bar_orders']+$query['pick_complete_dozen_orders']*12);
        if ($query['title'] == '剪巾') {
            DB::table('job_reports')->insert([
                'Piping' => $query['Piping'],
                'piping_order' => $query['cut_complete_bar_orders'] + $query['cut_complete_dozen_orders'] * 12,
                'cut_order' => $query['cut_complete_bar_orders'] + $query['cut_complete_dozen_orders'] * 12,
                'user_id' => $request->session()->get('user_id'),
                'ticket_id' => $query['ticket_id'],
                'created_at' => $query['date'],
                'updated_at' => $query['date'],
            ]);
        } elseif ($query['title'] == '折頭') {
            DB::table('job_foldhead_reports')->insert([
                'pickTower' => $query['pick_cloth_emp'],
                'foldHead_order' => $query['complete_bar_orders'] + $query['complete_dozen_orders'] * 12,
                'pickTower_order' => $query['pick_complete_bar_orders'] + $query['pick_complete_dozen_orders'] * 12,
                'user_id' => $request->session()->get('user_id'),
                'ticket_id' => $query['ticket_id'],
                'created_at' => $query['date'],
                'updated_at' => $query['date'],
            ]);
        }

        return redirect()->route('get_employee_menu');
    }
}
