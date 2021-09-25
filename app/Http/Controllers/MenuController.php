<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function get_menu()
    {
        return view('pages.login.menu');
    }
    // get addSheetUI
    public function get_addSheet()
    {
        return view('pages.login.addSheet');
    }

    public function post_addSheet(Request $request)
    {

        return redirect(route('get_menu'));
    }
}
