<?php

namespace App\Http\Controllers;

use App\Exports\JobTicketExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MenuController extends Controller
{
    public function get_menu()
    {
        // 派遣單查詢
        $job_tickets = DB::table('job_tickets')->get();

        //重置Session狀態
        Session::forget('qr_code_status');
        Session::forget('ticket_info');
//        dd($job_tickets);
        return view('pages.manager.menu',compact('job_tickets',$job_tickets));
    }

    public function get_search_data(Request $request)
    {
        $search_parameter = null;
        if ($request->search_parameter !== $search_parameter) {
            $search_parameter = $request->search_parameter;
        }

        //取得員工列表
        $data = DB::table('job_tickets')
            ->select('employeeName','id', 'itemId', 'order','status','created_at')
            ->where('employeeName', 'like', '%' . $search_parameter . '%')
            ->orwhere('status', 'like', '%' . $search_parameter . '%')
            ->orwhere('created_at', 'like BINARY', '%' . $search_parameter . '%')
            ->get();
        return $data;
    }

    // get addSheetUI
    public function get_addSheet()
    {
        $id = DB::table('job_tickets')->select('id')->orderBy("id",'desc')->first();
        if($id == null)
        {
            $id = 0;
        }
        else{
            $id = (int)$id->id;
        }
        return view('pages.manager.addSheet',compact('id',$id));
    }

    public function get_employeeDetail(Request $request,$id)
    {
        $employee = DB::table('users')->where('id', $id)->get();
        $tickets = DB::table('job_tickets');


        return view('pages.manager.employeeDetail');
    }

    public function post_create_addSheet(Request $request)
    {
        $query = $request->except('_token');
        $sum = $query['order_dozen'] * 12 + $query['order_bar'];
        DB::table('job_tickets')->insert([
            'created_at' =>$query['date'],
            'employeeName' =>$query['employeeName'],
            'item' =>$query['item'],
            'itemId' =>$query['itemId'],
            'factory' =>$query['factory'],
            'color' =>$query['color'],
            'colorId' =>$query['colorId'],
            'wash' =>$query['wash'],
            'colorId2' =>$query['colorId2'],
            'rollFunc' =>$query['rollFunc'],
            'manager' =>$query['manager'],
            'order' =>$sum,
            'ps' =>$query['ps'],
            'status' =>$query['status'],
        ]);
        return redirect(route('get_menu'));
    }
    // 查詢派遣單
    public function get_list($id)
    {
        $job_tickets = DB::table('job_tickets')->where('id',$id)->first();
//        dd($job_tickets);
        return view('pages.manager.list',compact('job_tickets',$job_tickets));
    }
    // 修改
    public function patch_patchSheet(Request $request)
    {
//        dd($request);
        $query = $request->except('_token');
        $sum = $query["order_dozen"] * 12 + $query["order_bar"];
//        dd($sum);
//        dd($query);
        DB::table('job_tickets')->where('id',$query['ticket_id'])
            ->update([
            'created_at' =>$query['date'],
            'employeeName' =>$query['employeeName'],
            'item' =>$query['item'],
            'itemId' =>$query['itemId'],
            'factory' =>$query['factory'],
            'color' =>$query['color'],
            'colorId' =>$query['colorId'],
            'wash' =>$query['wash'],
            'colorId2' =>$query['colorId2'],
            'rollFunc' =>$query['rollFunc'],
            'manager' =>$query['manager'],
            'order' =>$sum,
            'ps' =>$query['ps'],
            'status' =>$query['status'],
        ]);
        return redirect()->route('get_menu');
    }

    public function get_result(Request $request)
    {
        $ticket_id = $request->user_id;
        $job_ticket = DB::table('job_tickets')->where('id',$ticket_id)->first();
        $reports = DB::table('job_reports')->where('ticket_id',$ticket_id)->get();
        $foldHeadReports = DB::table('job_foldhead_reports')->where('ticket_id',$ticket_id)->get();
//        計算目前回報總數量
//        if($reports->count())
//        {
//            $sumReports = DB::table('job_reports')->where('ticket_id', $ticket_id)->sum('cut_order');
//            $sumPipReports = DB::table('job_reports')->where('ticket_id', $ticket_id)->sum('Piping_order');
//        }
//        if($foldHeadReports->count())
//        {
//            $sumFoldHeadReports = DB::table('job_foldhead_reports')->where('ticket_id', $ticket_id)->sum('foldHead_order');
//            $sumPickReports = DB::table('job_foldhead_reports')->where('ticket_id', $ticket_id)->sum('pickTower_order');
////            dd($sumPickReports);
//        }
//        dd($sumFoldHeadReports);
        return view('pages.manager.report',
            compact('reports','foldHeadReports','job_ticket','sumReports','sumFoldHeadReports','sumPipReports','sumPickReports'));
    }

    public function get_resultDetail($report,$sum1,$sum2,$id)
    {
        if($report =="cut"){
            $queries = DB::table('job_reports')->where('ticket_id',$id)->get();
//            dd($queries);
            return view('pages.manager.reportDetail',compact('queries','sum1','sum2','report'));
        }
        else if($report =="foldHead"){
            $queries = DB::table('job_foldhead_reports')->where('ticket_id',$id)->get();
//            dd($query);
            return view('pages.manager.reportDetail',compact('queries','sum1','sum2','report'));
        }

    }

    public function get_resultList($id,$report)
    {
        if ($report == 'cut' || $report == 'piping') {
            $queries = DB::table('job_reports')->where('ticket_id', $id)->get();
        } elseif ($report == 'foldHead' || $report == 'pickTower') {
            $queries = DB::table('job_foldhead_reports')->where('ticket_id', $id)->get();
        }
//        dd($queries);
        return view('pages.manager.reportList',compact('id','report','queries'));
    }
    //匯出excel
    public function export()
    {
        return Excel::download(new JobTicketExport, 'jobTickets.xlsx');
    }
}
