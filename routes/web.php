<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 登入
Route::get('/', 'LoginController@get_login_page')->name('get_login');
Route::post('/login', 'LoginController@post_login')->name('post_login');

// 登入middleware
Route::group(['middleware' =>['login']],function(){

    // 幹部
    Route::get('/menu', 'MenuController@get_menu')->name('get_menu');
    Route::get('/menu/addSheet', 'MenuController@get_addSheet')->name('get_addSheet');
    Route::post('/menu/addSheet/create', 'MenuController@post_create_addSheet')->name('post_create_addSheet');

    // 員工
    Route::get('/employee/menu', 'EmployeeMenuController@get_employee_menu')->name('get_employee_menu');
});


