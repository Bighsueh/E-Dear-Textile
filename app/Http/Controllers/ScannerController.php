<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;


class ScannerController extends Controller
{
    public function download_apk()
    {
        $path = public_path()."\apk\EDearTextileQrcodeScanner.apk";
        $headers = [
            'Content-Type'=>'application/vnd.android.package-archive',
        ];
        return response()->download($path,'EDearTextileQrcodeScanner.apk',$headers);
    }
    public function OpenScanner(Request $request, $method, $sub_attr)
    {
        //紀錄跳轉Scanner前使用者的狀態
        Session::put('method', $method);
        //紀錄跳轉Scanner前使用的單號
        Session::put('ticket_info', $sub_attr);

    }

    public function AfterScan(Request $request)
    {
        /*+
         * $method = 要做的事情
         *      ManagerToPiping 幹部掃滾邊
         *      ManagerToFoldHead 幹部掃折頭員
         *      CutToPiping 剪巾掃滾邊
         *
         * $authorizer = 授權人
         * $authorized_person = 被授權人
         *
         * */
        $ticket_id = '';
        $method = '';
        $value = '';
        $user_id = '';

        if (is_null($request->user_id)) {
            $user_id = $request->session()->get('user_id');
        } else {
            $user_id = $request->user_id;
        }
        $level = $request->session()->get('level');

        if (!is_null($request->session()->get('ticket_info'))) {
            $ticket_id = $request->session()->get('ticket_info');
        }

        if ($level === 'manager') {
            //若判斷是幹部的話就從 Session 讀取 method 狀態
            $method = $request->session()->get('method');
            //判斷是否為幹部掃滾邊員(被授權人,單號)
            if ($method === 'ManagerToPiping') $this->ManagerToPiping($user_id, $ticket_id);

            //判斷是否為幹部掃折頭員(被授權人,單號)
            if ($method === 'ManagerToFoldHead') $this->ManagerToFoldHead($user_id, $ticket_id);

            return redirect()->route('get_menu');
        }
        if ($level === 'employee') {

            if ($request->ticket_id !== '') $ticket_id = $request->ticket_id;

            //為剪巾掃滾邊(被授權人,單號)
            $this->CutToPiping($user_id, $ticket_id);

            return redirect()->route('get_employee_menu');
        }
    }

    function ManagerToPiping($authorized_person, $job_ticket_id)
    {
        try {
            $job_titles = DB::table('job_titles');
            $job_tickets = DB::table('job_tickets');
            $authorizer = Session::get('user_id');
            //判斷派遣單號(job_ticket_id)是否存在
            if ($job_tickets->where('id', $job_ticket_id)->first()) {
                //加入單號
                $job_titles->insert([
                    'ticket_id' => $job_ticket_id,
                    'authorizer' => $authorizer,
                    'authorized_person' => $authorized_person,
                    'title' => '滾邊',
                ]);
            }
        } catch (Exception $exception) {
            echo '資料庫寫入錯誤';
        }
    }

    function ManagerToFoldHead($authorized_person, $job_ticket_id)
    {
        try {
            $job_titles = DB::table('job_titles');
            $job_tickets = DB::table('job_tickets');
            $authorizer = Session::get('user_id');
            //判斷派遣單號(job_ticket_id)是否存在
            if ($job_tickets->where('id', $job_ticket_id)->first()) {
                //加入單號
                $job_titles->insert([
                    'ticket_id' => $job_ticket_id,
                    'authorizer' => $authorizer,
                    'authorized_person' => $authorized_person,
                    'title' => '折頭',
                ]);
            }
        } catch (Exception $exception) {
            echo '資料庫寫入錯誤';
        }
    }

    public function CutToPiping($authorizer, $job_ticket_id)
    {
        try {
            $job_titles = DB::table('job_titles');
            $job_tickets = DB::table('job_tickets');
            $authorized_person = Session::get('user_id');
            //判斷派遣單號(job_ticket_id)是否存在
            if ($job_tickets->where('id', $job_ticket_id)->first()) {
                //加入單號
                $job_titles->insert([
                    'ticket_id' => $job_ticket_id,
                    'authorizer' => $authorizer,
                    'authorized_person' => $authorized_person,
                    'title' => '剪巾',
                ]);
            }
        } catch (Exception $exception) {
            echo '資料庫寫入錯誤';
        }
    }
}
