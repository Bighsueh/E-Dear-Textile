<?php

namespace App\Exports;

use App\JobReport;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class JobReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $employee_id;
    protected $search_parameter;

    function __construct($employee_id,$search_parameter)
    {
        $this->employee_id = $employee_id;
        $this->search_parameter = $search_parameter;
    }


    public function view(): View
    {
        $search_parameter = null;
        if ($this->search_parameter !== $search_parameter) {
            $search_parameter = $this->search_parameter;
        }
        $data = DB::table('job_reports')
            ->where('operator', $this->employee_id)
            ->join('job_tickets', 'job_tickets.id', '=', 'job_reports.ticket_id')
            ->where('job_tickets.status', '出貨')
            ->orWhere('job_tickets.status', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.id', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.updated_at', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.employeeName', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.itemId', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.rollFunc', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_tickets.item', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_reports.quantity', 'like', '%' . $search_parameter . '%')
            ->orWhere('job_reports.unit', 'like', '%' . $search_parameter . '%')
            ->get();



        return view('pages.exports.jobReport', [
            'data' => $data
        ]);
    }
}
