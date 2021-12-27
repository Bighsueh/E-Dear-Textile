<?php

namespace App\Exports;

use App\DefaultTicketContent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DefaultTicketContentExport implements FromView
{
    public function view(): View
    {
        return view('pages.exports.ticketSetting', ['data' => DefaultTicketContent::all()]);
    }
}
