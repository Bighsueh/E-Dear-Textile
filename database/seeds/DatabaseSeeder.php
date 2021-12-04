<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(JobTicketsTableSeeder::class);
        $this->call(ReportTableSeeder::class);
        $this->call(TitleTableSeeder::class);
    }
}
