<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function get_menu()
    {
        // 派遣單查詢
        $job_tickets = DB::table('job_tickets')->get();

        //重置Session狀態
        Session::forget('qr_code_status');
        Session::forget('ticket_info');

        return view('pages.manager.menu',compact('job_tickets',$job_tickets));
    }
    // get addSheetUI
    public function get_addSheet()
    {
        $id = DB::table('job_tickets')->select('id')->orderBy("id",'desc')->first();
        return view('pages.manager.addSheet',compact('id',$id));
    }

    public function get_employeeList()
    {
        $users = DB::table('users')->get();


        return view('pages.manager.employeeList',compact('users',$users));
    }

    public function post_create_addSheet(Request $request)
    {
        $query = $request->except('_token');
        DB::table('job_tickets')->insert([
            'date' =>$query['date'],
            'employeeName' =>$query['employeeName'],
            'item' =>$query['item'],
            'itemId' =>$query['itemId'],
            'factory' =>$query['factory'],
            'color' =>$query['color'],
            'colorId' =>$query['colorId'],
            'wash' =>$query['wash'],
            'colorId2' =>$query['colorId2'],
            'cloth' =>$query['cloth'],
            'rollFunc' =>$query['rollFunc'],
            'manager' =>$query['manager'],
            'order' =>$query['order'],
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
        $query = $request->except('_token');
//        dd($query);
        DB::table('job_tickets')->where('id',$query['ticket_id'])
            ->update([
            'date' =>$query['date'],
            'employeeName' =>$query['employeeName'],
            'item' =>$query['item'],
            'itemId' =>$query['itemId'],
            'factory' =>$query['factory'],
            'color' =>$query['color'],
            'colorId' =>$query['colorId'],
            'wash' =>$query['wash'],
            'colorId2' =>$query['colorId2'],
            'cloth' =>$query['cloth'],
            'rollFunc' =>$query['rollFunc'],
            'manager' =>$query['manager'],
            'order' =>$query['order'],
            'ps' =>$query['ps'],
            'status' =>$query['status'],
        ]);
        return redirect()->route('get_menu');
    }

    public function get_result(Request $request)
    {
//        dd($request);
        $ticket_id = $request->except('_token');
        $job_ticket = DB::table('job_tickets')->where('id',$ticket_id)->first();
        $reports = DB::table('job_reports')->where('ticket_id',$ticket_id)->get();
        $foldHeadReports = DB::table('job_foldhead_reports')->where('ticket_id')->get();
        if($reports->count())
        {
            $sumReports = DB::table('job_reports')->where('ticket_id', $ticket_id)->sum('cut_order');
        }
        if($foldHeadReports->count())
        {
            $sumFoldHeadReports = DB::table('foldHeadReports')->where('ticket_id', $ticket_id)->sum('pickTower');
        }
//        dd($foldHeadReports);
        return view('pages.manager.report',compact('reports','foldHeadReports','job_ticket','sumReports','sumFoldHeadReports'));
    }

    public function get_resultDetail($report,$id)
    {
        return view('pages.manager.reportDetail');
    }
}
