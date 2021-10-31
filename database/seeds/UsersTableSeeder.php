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
//      幹部
        DB::table('users')->insert([
            'user_id' =>'40841145',
            'name' =>'yoyo',
            'account' =>'123',
            'password' =>'456',
            'level' =>'manager',
        ]);
//      滾邊
        DB::table('users')->insert([
            'user_id' =>'408411455',
            'name' =>'yoyooo',
            'account' =>'456',
            'password' =>'789',
            'level' =>'employee',
        ]);
//      滾邊2
        DB::table('users')->insert([
            'user_id' =>'4084114552',
            'name' =>'yoyooo2',
            'account' =>'4566',
            'password' =>'7899',
            'level' =>'employee',
        ]);
//      剪巾
        DB::table('users')->insert([
            'user_id' =>'408411455cut',
            'name' =>'yoyocut',
            'account' =>'456cut',
            'password' =>'789cut',
            'level' =>'employee',
        ]);
//      剪巾2
        DB::table('users')->insert([
            'user_id' =>'408411455cut2',
            'name' =>'yoyocut2',
            'account' =>'4566cut',
            'password' =>'7899cut',
            'level' =>'employee',
        ]);
    }
}
