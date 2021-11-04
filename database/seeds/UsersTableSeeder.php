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
            'user_id' =>'408411455piping',
            'name' =>'yoyooo',
            'account' =>'piping',
            'password' =>'piping',
            'level' =>'employee',
        ]);
//      滾邊2
        DB::table('users')->insert([
            'user_id' =>'408411455piping2',
            'name' =>'yoyooo2',
            'account' =>'piping2',
            'password' =>'piping2',
            'level' =>'employee',
        ]);
//      剪巾
        DB::table('users')->insert([
            'user_id' =>'408411455cut',
            'name' =>'yoyocut',
            'account' =>'cut',
            'password' =>'cut',
            'level' =>'employee',
        ]);
//      剪巾2
        DB::table('users')->insert([
            'user_id' =>'408411455cut2',
            'name' =>'yoyocut2',
            'account' =>'cut2',
            'password' =>'cut2',
            'level' =>'employee',
        ]);
//      折頭
        DB::table('users')->insert([
            'user_id' =>'408411455head',
            'name' =>'yoyohead',
            'account' =>'head',
            'password' =>'head',
            'level' =>'employee',
        ]);
//      折頭2
        DB::table('users')->insert([
            'user_id' =>'408411455head2',
            'name' =>'yoyohead2',
            'account' =>'head2',
            'password' =>'head2',
            'level' =>'employee',
        ]);
//      撿巾
        DB::table('users')->insert([
            'user_id' =>'408411455pick',
            'name' =>'yoyopick',
            'account' =>'pick',
            'password' =>'pick',
            'level' =>'employee',
        ]);
    }
}
