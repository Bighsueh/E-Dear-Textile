<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function get_menu()
    {
        // 派遣單查詢
        $job_tickets = DB::table('job_tickets')->get();
        return view('pages.login.menu',compact('job_tickets',$job_tickets));
    }
    // get addSheetUI
    public function get_addSheet()
    {
        return view('pages.login.addSheet');
    }

    public function post_create_addSheet(Request $request)
    {
        $query = $request->except('_token');
        DB::table('job_tickets')->insert([
            'ticket_id' =>$query['ticket_id'],
            'employeeName' =>$query['employeeName'],
            'item' =>$query['item'],
            'itemId' =>$query['itemId'],
            'factory' =>$query['factory'],
            'color' =>$query['color'],
            'colorId' =>$query['colorId'],
            'cloth' =>$query['cloth'],
            'rollFunc' =>$query['rollFunc'],
            'manager' =>$query['manager'],
            'order' =>$query['order'],
            'ps' =>$query['ps'],
            'wash' =>$query['wash'],
        ]);
        return redirect(route('get_menu'));
    }
}
