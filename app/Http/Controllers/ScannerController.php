<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScannerController extends Controller
{
    public function OpenScanner(Request $request,$qr_code_status)
    {
        $user_id = $request->session()->get('user_id');
        $level = $request->session()->get('level');

        Session::put('qr_code_status',$qr_code_status);

        return redirect('app://open');
    }



    public function ManagerToFoldHead(Request $request)
    {

    }

    public function CutToPiping(Request $request)
    {

    }
}
