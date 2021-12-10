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
Route::get('/c', function () {
    return view('pages.customer.customerMenu');
});

// 登入
Route::get('/', 'LoginController@get_login_page')->name('get_login');
Route::post('/login', 'LoginController@post_login')->name('post_login');

//apk下載
Route::get('/download_apk', 'ScannerController@download_apk')->name('download_apk');

// 登入middleware，檢查對應權限
Route::group(['middleware' =>['login']],function(){
    //QrCode掃描功能
    //開啟Scanner
    Route::get('/openScanner/{qr_code_status}/{sub_attr?}', 'ScannerController@OpenScanner')->name('open_scanner');
    //掃描後處理
    Route::get('/afterScan', 'ScannerController@AfterScan')->name('after_scanner');


    // 幹部
    Route::get('/manager/menu', 'MenuController@get_menu')->name('get_menu');
    Route::get('/manager/menu/search', 'MenuController@get_search_data')->name('get_search_data');
    Route::get('/manager/menu/addSheet', 'MenuController@get_addSheet')->name('get_addSheet');
    Route::get('/manager/menu/list/{id}', 'MenuController@get_list')->name('get_list');
    Route::post('/manager/menu/addSheet/create', 'MenuController@post_create_addSheet')->name('post_create_addSheet');
    Route::patch('/manager/menu/patchSheet', 'MenuController@patch_patchSheet')->name('patch_patchSheet');
    Route::get('/manager/menu/result','MenuController@get_result')->name('get_result');
    Route::get('/manager/menu/result/detail','MenuController@get_resultDetail')->name('get_resultDetail');
    Route::get('/manager/menu/result/list','MenuController@get_resultList')->name('get_resultList');
    //匯出派遣單excel
    Route::get('/manager/menu/excel', 'MenuController@export')->name('menu_export');


//    Route::get('/manager/menu/employeeDetail/{id}','MenuController@get_employeeDetail')->name('get_employee_detail');

    //幹部-員工資料
    Route::get('/manager/menu/employeeList','UserController@get_user_page')->name('get_user_page');
    Route::get('/manager/menu/getUserData','UserController@get_user_data')->name('get_employee_data');
    Route::post('/manager/menu/createUserData','UserController@create_user_data')->name('create_user_data');
    Route::get('/manager/menu/getEditUserData','UserController@get_edit_data')->name('get_edit_data');
    Route::post('/manager/menu/storeEditUserData','UserController@store_edit_data')->name('store_edit_data');
    Route::post('/manager/menu/deleteEditUserData','UserController@delete_edit_data')->name('delete_edit_data');

    //幹部-員工工作紀錄
    Route::get('/manager/WorkingLog', 'WorkingLogController@get_working_log_page')->name('get_working_log_page');
    Route::get('/manager/getWorkingLogData', 'WorkingLogController@get_working_log_data')->name('get_working_log_data');

    //輸出Excel
    Route::get('/excel', 'WorkingLogController@export_excel')->name('working_job_export_excel');
    // 員工
    Route::get('/employee/menu', 'EmployeeMenuController@get_employee_menu')->name('get_employee_menu');
    // 將資料傳入回報Modal
    Route::get('/employee/menu/getReportData', 'EmployeeMenuController@get_report_data')->name('get_report_data');
    Route::get('/employee/menu/storeReportData','EmployeeMenuController@store_report_data')->name('store_report_data');
    // 將資料傳入回報的頁面
    Route::post('/employee/menu/report','EmployeeMenuController@post_employee_report')->name('post_employee_report');
    // 將回報結果加入資料庫
    Route::post('/employee/menu/report/create', 'EmployeeMenuController@post_create_employee_report')->name('post_create_employee_report');
    // 查看派遣單細項
    Route::get('/employee/list/{id}', 'EmployeeMenuController@get_employee_list')->name('get_employee_list');


    //顧客
    Route::get('/customer/confirmCustomer', 'CustomerController@confirm_customer')->name('confirm_customer');
    Route::get('/customer/getTicketsData', 'CustomerController@get_tickets_data')->name('get_tickets_data');
});


