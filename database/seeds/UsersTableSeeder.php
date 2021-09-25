<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id' =>'40841145',
            'name' =>'yoyo',
            'account' =>'123',
            'password' =>'456',
            'level' =>'admin',
        ]);
    }
}
