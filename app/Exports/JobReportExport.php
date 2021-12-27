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
            ->join('job_tickets', 'job_tickets.id', '=', 'job_reports.ticket_id');

        if ($search_parameter) {
            $data = $data->where(function ($query) use ($search_parameter){
                $query->orWhere('job_tickets.status', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.id', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.updated_at', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.employeeName', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.itemId', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.rollFunc', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_tickets.item', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_reports.quantity', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_reports.unit', 'like binary', '%' . $search_parameter . '%')
                    ->orWhere('job_reports.action', 'like binary', '%' . $search_parameter . '%');
            });
        }
        $data = $data->where('job_reports.operator', '=', $this->employee_id)->get();

        return view('pages.exports.jobReport', [
            'data' => $data
        ]);
    }
}
