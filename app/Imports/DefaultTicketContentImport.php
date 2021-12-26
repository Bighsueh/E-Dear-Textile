<?php

namespace App\Imports;

use App\DefaultTicketContent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DefaultTicketContentImport implements ToModel,WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        // TODO: Implement startRow() method.
        //移除標題欄位
        return 2;
    }


    public function model(array $row)
    {
        return new DefaultTicketContent([
            'customer_name' => $row[0],
            'item_no' => $row[1],
            'color' => $row[2],
            'wash_tag' => $row[3],
            'item' => $row[4],
            'blenching_and_dyeing_factory' => $row[5],
            'color_thread' => $row[6],
            'piping_method' => $row[7],
            'remark' => $row[8],
            'ticket_status' => $row[9]
        ]);
    }
}
