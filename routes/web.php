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
    //QrCode掃描功能
    //開啟Scanner
    Route::get('/openScanner/{qr_code_status}/{sub_attr?}', 'ScannerController@OpenScanner')->name('open_scanner');
    //掃描後處理
    Route::get('/afterScan/{method}/{value}', 'ScannerController@AfterScan')->name('after_scanner');


    // 幹部
    Route::get('/menu', 'MenuController@get_menu')->name('get_menu');
    Route::get('/menu/addSheet', 'MenuController@get_addSheet')->name('get_addSheet');
    Route::get('/menu/list/{id}', 'MenuController@get_list')->name('get_list');
    Route::post('/menu/addSheet/create', 'MenuController@post_create_addSheet')->name('post_create_addSheet');
    Route::patch('/menu/patchSheet', 'MenuController@patch_patchSheet')->name('patch_patchSheet');
    Route::get('/menu/result','MenuController@get_result')->name('get_result');

    // 員工
    Route::get('/employee/menu', 'EmployeeMenuController@get_employee_menu')->name('get_employee_menu');
    // 將資料傳入回報的頁面
    Route::post('/employee/menu/report','EmployeeMenuController@post_employee_report')->name('post_employee_report');
    // 將回報結果加入資料庫
    Route::post('/employee/menu/report/create', 'EmployeeMenuController@post_create_employee_report')->name('post_create_employee_report');
    // 查看派遣單細項
    Route::get('/employee/list/{id}', 'EmployeeMenuController@get_employee_list')->name('get_employee_list');
});


