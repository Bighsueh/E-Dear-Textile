<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_titles')->insert([
            'id' =>'1',
            'ticket_id' =>'1',
            'title' =>'滾邊',
            'authorizer' =>'1',
            'authorized_person' =>'3'
        ]);
        DB::table('job_titles')->insert([
            'id' =>'2',
            'ticket_id' =>'1',
            'title' =>'剪巾',
            'authorizer' =>'3',
            'authorized_person' =>'5'
        ]);
        DB::table('job_titles')->insert([
            'id' =>'3',
            'ticket_id' =>'1',
            'title' =>'折頭',
            'authorizer' =>'2',
            'authorized_person' =>'7'
        ]);

    }
}
