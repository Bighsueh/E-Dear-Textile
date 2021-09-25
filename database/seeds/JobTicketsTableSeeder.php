<?php

use Illuminate\Database\Seeder;

class JobTicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_tickets')->insert([
            'ticket_id' =>'1995123',
            'employeeName' =>'彩虹彩虹',
            'item' =>'500',
            'itemId' =>'1150',
            'factory' =>'yoyoyo',
            'color' =>'yellow',
            'colorId' =>'sdf',
            'cloth' =>'af',
            'rollFunc' =>'f',
            'manager' =>'yo',
            'order' =>'100',
            'ps' =>'無',
            'wash' =>'123',
        ]);
    }
}
