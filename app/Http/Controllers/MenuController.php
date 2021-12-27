<?php

namespace App\Http\Controllers;

use App\DefaultTicketContent;
use App\Exports\DefaultTicketContentExport;
use App\Exports\JobTicketExport;
use App\Imports\DefaultTicketContentImport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MenuController extends Controller
{
    public function get_menu()
    {
        // 派遣單查詢
        $job_tickets = DB::table('job_tickets');

        //重置Session狀態
        Session::forget('qr_code_status');
        Session::forget('ticket_info');

        return view('pages.manager.menu');
    }

    public function get_search_data(Request $request)
    {
        $now = Carbon::now();
        $result = [];
        $search_parameter = null;

        //設定搜尋值初始值
        if ($request->search_parameter !== $search_parameter) {
            $search_parameter = $request->search_parameter;
        }

        //取得員工列表
        $job_tickets = DB::table('job_tickets')
            ->select('employeeName', 'id', 'itemId', 'order', 'status', 'created_at')
            ->where('employeeName', 'like', '%' . $search_parameter . '%')
            ->orwhere('status', 'like', '%' . $search_parameter . '%')
            ->orwhere('created_at', 'like BINARY', '%' . $search_parameter . '%')
            ->orwhere('itemId', 'like', '%' . $search_parameter . '%')
            ->get();


        //設定傳出數值
        foreach ($job_tickets as $row){
            array_push($result, [
                'employeeName' => $row->employeeName,
                'id'=>$row->id,
                'itemId'=>$row->itemId,
                'order'=>$row->order,
                'status'=>$row->status,
                'created_at'=>$row->created_at,
                'diff_days' => Carbon::parse($now)->diff($row->created_at)->days,
                'diff_months' => Carbon::parse($row->created_at)->diffInMonths($now),
            ]);
        }


        return $result;
    }

    // get addSheetUI
    public function get_addSheet()
    {
        $id = DB::table('job_tickets')->select('id')->orderBy("id", 'desc')->first();
        $user_name = DB::table('users')->select('name')->where('id', Session::get('user_id'))->first()->name;
        if ($id == null) {
            $id = 0;
        } else {
            $id = (int)$id->id;
        }
        return view('pages.manager.addSheet', compact('id', 'user_name'));
    }

    public function get_default()
    {
        $default = DB::table('default_ticket_content')
            ->select('customer_name','item_no','color','wash_tag','item'
                ,'blenching_and_dyeing_factory','color_thread','piping_method','remark','ticket_status')->get();
        return $default;
    }
    public function get_employeeDetail(Request $request, $id)
    {
        $employee = DB::table('users')->where('id', $id)->get();
        $tickets = DB::table('job_tickets');


        return view('pages.manager.employeeDetail');
    }

    public function post_create_addSheet(Request $request)
    {
        $query = $request->except('_token');
        if ($query['order_unit'] == '1') {
            $sum = $query['order'];
        } else {
            $sum = $query['order'] * 12;
        }
        DB::table('job_tickets')->insert([
            'created_at' => $query['date'],
            'employeeName' => $query['customer_name'],
            'item' => $query['item'],
            'itemId' => $query['item_no'],
            'factory' => $query['blenching_and_dyeing_factory'],
            'color' => $query['color'],
            'wash' => $query['wash_tag'],
            'color_line' => $query['color_thread'],
            'rollFunc' => $query['piping_method'],
            'manager' => $query['manager'],
            'order' => $sum,
            'ps' => $query['remark'],
            'status' => $query['ticket_status'],
        ]);
        return redirect(route('get_menu'));
    }

    // 查詢派遣單
    public function get_list($id)
    {
        $job_tickets = DB::table('job_tickets')->where('id', $id)->first();
//        dd($job_tickets);
        return view('pages.manager.list', compact('job_tickets', $job_tickets));
    }

    // 修改
    public function patch_patchSheet(Request $request)
    {
//        dd($request);
        $query = $request->except('_token');
        $sum = $query["order_dozen"] * 12 + $query["order_bar"];
//        dd($sum);
//        dd($query);
        DB::table('job_tickets')->where('id', $query['ticket_id'])
            ->update([
                'created_at' => $query['date'],
                'employeeName' => $query['employeeName'],
                'item' => $query['item'],
                'itemId' => $query['itemId'],
                'factory' => $query['factory'],
                'color' => $query['color'],
                'color_line' => $query['color_line'],
                'wash' => $query['wash'],
                'rollFunc' => $query['rollFunc'],
                'manager' => $query['manager'],
                'order' => $sum,
                'ps' => $query['ps'],
                'status' => $query['status'],
            ]);
        return redirect()->route('get_menu');
    }

    public function get_result(Request $request)
    {
        $ticket_id = $request->user_id;
        $ticket = DB::table('job_tickets')->where('id', $ticket_id)->get();

        $cut_order_dozen = DB::table('job_reports')->where('ticket_id', $ticket_id)
            ->where('unit', 'dozen')
            ->where('action', "剪巾")->sum('quantity');
        $cut_order_bar = DB::table('job_reports')->where('ticket_id', $ticket_id)
            ->where('unit', 'one')
            ->where('action', "剪巾")->sum('quantity');

        $foldHead_order_bar = DB::table('job_reports')->where('ticket_id', $ticket_id)
            ->where('action', "折頭")
            ->where('unit', 'one')
            ->sum('quantity');
        $foldHead_order_dozen = DB::table('job_reports')->where('ticket_id', $ticket_id)
            ->where('action', "折頭")
            ->where('unit', 'dozen')
            ->sum('quantity');

        $cut_order = $cut_order_dozen * 12 + $cut_order_bar;
        $foldHead = $foldHead_order_dozen * 12 + $foldHead_order_bar;

        return [$ticket, $cut_order, $foldHead];
    }

    public function get_resultDetail(Request $request)
    {
        // 剪巾或折頭的查詢
        $report = DB::table('job_reports')
            ->join('users', 'job_reports.operator', 'users.id')
            ->where('ticket_id', $request->user_id)
            ->where('action', $request->action)
            ->select('job_reports.action', 'job_reports.quantity', 'users.name')
            ->get();
        $sub_report = null;
        // 帶出需要幫忙回報的人員
        if ($request->action == '剪巾') {
            $sub_report = DB::table('job_reports')
                ->join('users', 'job_reports.operator', 'users.id')
                ->where('ticket_id', $request->user_id)
                ->where('action', '滾邊')
                ->select('job_reports.action', 'job_reports.quantity', 'users.name')
                ->get();

        } else if ($request->action == '折頭') {
            $sub_report = DB::table('job_reports')
                ->join('users', 'job_reports.operator', 'users.id')
                ->where('ticket_id', $request->user_id)
                ->where('action', '撿巾')
                ->select('job_reports.action', 'job_reports.quantity', 'users.name')
                ->get();
        }

        return [$report, $sub_report, $request->num, $request->unit];

    }

    public function get_resultList(Request $request)
    {
        //operator
        $report = DB::table('job_reports')
            ->join('users', 'job_reports.operator', 'users.id')
            ->where('action', $request->action)
            ->where('ticket_id', $request->user_id)
            ->select('users.name', 'job_reports.quantity', 'job_reports.created_at')
            ->get();
        $submit_by = DB::table('job_reports')
            ->join('users', 'job_reports.submit_by', 'users.id')
            ->where('action', $request->action)
            ->where('ticket_id', $request->user_id)
            ->select('users.name')
            ->get();
        return [$report, $submit_by, $request->action];
    }

    //匯出派遣單 excel
    public function export_job_ticket()
    {
        return Excel::download(new JobTicketExport, 'jobTickets.xlsx');
    }

    //匯入派遣單預設值(下拉式選單)excel
    public function import_default_ticket_content(Request $request)
    {
        $file = $request->file('upload_file');

        DefaultTicketContent::truncate();

        Excel::import(new DefaultTicketContentImport, $file);

        return 'success';
    }

    //匯出派遣單預設值(下拉式選單)excel
    public function export_default_ticket_content()
    {
        $file_name = '內建下拉選單資料.xlsx';
        return Excel::download(new DefaultTicketContentExport(), $file_name);
    }

    //取得派遣單預設值(下拉式選單)資料
    public function get_default_ticket_setting_data()
    {
        $table_ticket_content = DB::table('default_ticket_content');

        $data = [
            'customer_name' => $table_ticket_content->get('customer_name'),
            'item_no' => $table_ticket_content->get('item_no'),
            'color' => $table_ticket_content->get('color'),
            'wash_tag' => $table_ticket_content->get('wash_tag'),
            'item' => $table_ticket_content->get('item'),
            'blenching_and_dyeing_factory' => $table_ticket_content->get('blenching_and_dyeing_factory'),
            'color_thread' => $table_ticket_content->get('color_thread'),
            'piping_method' => $table_ticket_content->get('piping_method'),
            'remark' => $table_ticket_content->get('remark'),
            'ticket_status' => $table_ticket_content->get('ticket_status')
        ];

        return $data;
    }
}
