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
        $ticket = DB::table('job_tickets')->where('id', $ticket_id)->get();

        $cut_order_dozen = DB::table('job_reports')->where('ticket_id', $ticket_id)
            ->where('unit','dozen')
            ->where('action',"剪巾")->sum('quantity');
        $cut_order_bar = DB::table('job_reports')->where('ticket_id', $ticket_id)
            ->where('unit','one')
            ->where('action',"剪巾")->sum('quantity');

        $foldHead_order_bar = DB::table('job_reports')->where('ticket_id', $ticket_id)
            ->where('action',"折頭")
            ->where('unit','one')
            ->sum('quantity');
        $foldHead_order_dozen = DB::table('job_reports')->where('ticket_id', $ticket_id)
            ->where('action',"折頭")
            ->where('unit','dozen')
            ->sum('quantity');

        $cut_order = $cut_order_dozen*12 + $cut_order_bar;
        $foldHead = $foldHead_order_dozen*12+$foldHead_order_bar;

        return [$ticket,$cut_order,$foldHead];
    }

    public function get_resultDetail(Request $request)
    {
        // 剪巾或折頭的查詢
        $report = DB::table('job_reports')
            ->where('ticket_id', $request->user_id)
            ->where('action', $request->action)->get();
        $sub_report = null;
        // 帶出需要幫忙回報的人員
        if($request->action =='剪巾'){
            $sub_report = DB::table('job_reports')
                ->select('action','quantity','operator')
                ->where('ticket_id', $request->user_id)
                ->where('action', '滾邊')->get();
        }
        else if($request->action =='折頭'){
            $sub_report = DB::table('job_reports')
                ->select('action','quantity','operator')
                ->where('ticket_id', $request->user_id)
                ->where('action', '撿巾')->get();
        }

        return [$report,$sub_report,$request->num,$request->unit];

    }

    public function get_resultList(Request $request)
    {
        $report = DB::table('job_reports')
            ->where('action',$request->action)
            ->where('ticket_id',$request->user_id)->get();
       return [$report,$request->action];
    }
    //匯出excel
    public function export()
    {
        return Excel::download(new JobTicketExport, 'jobTickets.xlsx');
    }
}
