<?php

use Illuminate\Database\Seeder;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_reports')->insert([
            'id' =>'1',
            'action' =>'滾邊',
            'operator' =>'3',
            'ticket_id' =>'1',
            'quantity' =>'100',
            'unit' =>'one',
            'submit_by' =>'5',
        ]);
        DB::table('job_reports')->insert([
            'id' =>'2',
            'action' =>'剪巾',
            'operator' =>'5',
            'ticket_id' =>'1',
            'quantity' =>'100',
            'unit' =>'one',
            'submit_by' =>'5',
        ]);
    }
}
