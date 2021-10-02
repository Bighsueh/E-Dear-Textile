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
            'id' =>'1',
            'date' =>'2020/12/12',
            'employeeName' =>'彩虹彩虹',
            'item' =>'500',
            'itemId' =>'1150',
            'factory' =>'yoyoyo',
            'color' =>'yellow',
            'colorId' =>'sdf',
            'colorId2' =>'asd',
            'cloth' =>'af',
            'rollFunc' =>'f',
            'manager' =>'yo',
            'order' =>'100',
            'ps' =>'無',
            'wash' =>'123',
            'status' =>'排程中',
        ]);
    }
}
