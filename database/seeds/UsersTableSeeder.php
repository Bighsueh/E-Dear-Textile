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
//      系統管理員
        DB::table('users')->insert([
            'name' => '系統管理員',
            'account' => 'admin',
            'password' => 'admin',
            'level' => 'admin'
        ]);

//      幹部1
        DB::table('users')->insert([
            'name' => '幹部1',
            'account' => 'm01',
            'password' => 'm01',
            'level' => 'manager',
        ]);
//      幹部2
        DB::table('users')->insert([
            'name' => '幹部2',
            'account' => 'm02',
            'password' => 'm02',
            'level' => 'manager',
        ]);

//      滾邊
        DB::table('users')->insert([
            'name' => '滾邊1',
            'account' => 'piping1',
            'password' => 'piping1',
            'level' => 'employee',
        ]);
//      滾邊2
        DB::table('users')->insert([
            'name' => '滾邊2',
            'account' => 'piping2',
            'password' => 'piping2',
            'level' => 'employee',
        ]);
//      剪巾
        DB::table('users')->insert([
            'name' => '剪巾1',
            'account' => 'cut1',
            'password' => 'cut1',
            'level' => 'employee',
        ]);
//      剪巾2
        DB::table('users')->insert([
            'name' => '剪巾2',
            'account' => 'cut2',
            'password' => 'cut2',
            'level' => 'employee',
        ]);
//      折頭
        DB::table('users')->insert([
            'name' => '折頭1',
            'account' => 'head1',
            'password' => 'head1',
            'level' => 'employee',
        ]);
//      折頭2
        DB::table('users')->insert([
            'name' => '折頭2',
            'account' => 'head2',
            'password' => 'head2',
            'level' => 'employee',
        ]);
//      撿巾
        DB::table('users')->insert([
            'name' => '撿巾1',
            'account' => 'pick1',
            'password' => 'pick1',
            'level' => 'employee',
        ]);
        //      撿巾
        DB::table('users')->insert([
            'name' => '撿巾2',
            'account' => 'pick2',
            'password' => 'pick2',
            'level' => 'employee',
        ]);

    }
}
