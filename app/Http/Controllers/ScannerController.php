<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;


class ScannerController extends Controller
{
    public function OpenScanner(Request $request,$qr_code_status,$sub_attr)
    {
        $user_id = $request->session()->get('user_id');
        $level = $request->session()->get('level');

        //紀錄跳轉Scanner前使用者的狀態
        Session::put('qr_code_status',$qr_code_status);
        //紀錄跳轉Scanner前使用的單號
        Session::put('ticket_info', $sub_attr);

        return redirect('app://open');
    }

    public function AfterScan(Request $request,$method,$value)
    {
        $qr_code_status = "";
        $level = $request->session()->get('level');
        if ($level === "manager") {
            //判斷是否為幹部掃員工
            $qr_code_status = $request->session()->get('qr_code_status');
        }


        //判斷是否為幹部掃滾邊員
        if ($qr_code_status === 'ManagerToPiping') {
            //value 為 員工id
            $user_id = $value;
            $ticket_id = $request->session()->get('ticket_info');
            $this->ManagerToPiping($user_id, $ticket_id);
        }

        //判斷是否為幹部掃折頭員
        if ($qr_code_status === 'ManagerToFoldHead') {
            //value 為 員工id
            $user_id = $value;
            $ticket_id = $request->session()->get('ticket_info');
            $this->ManagerToFoldHead($user_id, $ticket_id);
        }

        //判斷是否為剪巾掃滾邊
        if($method === 'CutToPiping'){
            //value 為 單號id
            $user_id = $request->session()->get('user_id');
            $ticket_id = $value;
            $this->ManagerToPiping($user_id, $ticket_id);
        }


        //依照level判斷轉址頁面
        if ($level === 'manager') {
            return redirect()->route('get_menu');
        }
        if ($level === 'employee') {
            return redirect()->route('get_employee_menu');
        }

    }
   function ManagerToPiping($user_id,$job_ticket_id)
    {
        try {
            $job_titles = DB::table('job_titles');
            $job_tickets = DB::table('job_tickets');

            //判斷派遣單號(job_ticket_id)是否存在
            if ($job_tickets->where('id', $job_ticket_id)->first()) {
                //加入單號
                $job_titles->insert([
                    'ticket_id' => $job_ticket_id,
                    'user_id' => $user_id,
                    'title' => '滾邊',
                ]);
            }
        } catch (Exception $exception) {
            echo '資料庫寫入錯誤';
        }
    }

    function ManagerToFoldHead($user_id,$job_ticket_id)
    {
        try {
            $job_titles = DB::table('job_titles');
            $job_tickets = DB::table('job_tickets');

            //判斷派遣單號(job_ticket_id)是否存在
            if ($job_tickets->where('id', $job_ticket_id)->first()) {
                //加入單號
                $job_titles->insert([
                    'ticket_id' => $job_ticket_id,
                    'user_id' => $user_id,
                    'title' => '折頭',
                ]);
            }
        } catch (Exception $exception) {
            echo '資料庫寫入錯誤';
        }
    }

    public function CutToPiping($user_id,$job_ticket_id)
    {
        try {
            $job_titles = DB::table('job_titles');
            $job_tickets = DB::table('job_tickets');

            //判斷派遣單號(job_ticket_id)是否存在
            if ($job_tickets->where('id', $job_ticket_id)->first()) {
                //加入單號
                $job_titles->insert([
                    'ticket_id' => $job_ticket_id,
                    'user_id' => $user_id,
                    'title' => '剪巾',
                ]);
            }
        } catch (Exception $exception) {
            echo '資料庫寫入錯誤';
        }
    }
}
