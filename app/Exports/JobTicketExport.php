<?php

namespace App\Exports;

use App\JobTicket;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class JobTicketExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('pages.exports.jobTicket', [
            'data' => JobTicket::all()
        ]);
    }
}
