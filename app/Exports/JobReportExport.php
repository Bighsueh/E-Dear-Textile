<?php

namespace App\Exports;

use App\JobReport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class JobReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('pages.exports.jobReport', [
            'data' => JobReport::all()
        ]);
    }
}
