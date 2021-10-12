<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeMenuController extends Controller
{
    public function get_employee_menu()
    {
        // 派遣單查詢
        $job_tickets = DB::table('job_tickets')->get();
        return view('pages.employee.employeeMenu',compact('job_tickets',$job_tickets));
    }
}
