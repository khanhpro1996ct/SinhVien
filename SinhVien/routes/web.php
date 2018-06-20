<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/index', 'Controller@index')->name('admin');
Route::get('user/{id}/index', 'SinhVienController@show')->name('user.show');

Route::group(['prefix' => 'khoa'], function () {
    Route::post('luu', 'KhoaController@luu')->name('khoa.luu');
    Route::get('them', 'KhoaController@them')->name('khoa.them');
    Route::get('giaodien', 'KhoaController@giaodien')->name('khoa.giaodien');
    Route::get('sua/{id}', 'KhoaController@sua')->name('khoa.sua');
    Route::post('capnhat/{id}', 'KhoaController@capnhat')->name('khoa.capnhat');
    Route::get('xoa/{id}', 'KhoaController@xoa')->name('khoa.xoa');
});

Route::group(['prefix' => 'nganh'], function () {
    Route::get('index', 'NganhController@index')->name('nganh.index');
    Route::post('khoa-store', 'NganhController@store');
    Route::post('nganh-store', 'NganhController@store');
    Route::get('nganh-data', 'NganhController@getNganh')->name('nganh.getNganh');
    Route::get('nganh-get-khoa', 'NganhController@getKhoabyId')->name('nganh.getKhoabyId');
    Route::get('create', 'NganhController@create')->name('nganh.create');
    Route::post('store', 'NganhController@store')->name('nganh.store');
    Route::post('update/{id}', 'NganhController@update')->name('nganh.update');
    Route::get('edit/{id}', 'NganhController@edit')->name('nganh.edit');
    Route::get('destroy/{id}', 'NganhController@destroy')->name('nganh.destroy');
});

Route::group(['prefix' => 'lop'], function () {
    Route::get('index', 'LopController@index')->name('lop.index');
    Route::get('create', 'LopController@create')->name('lop.create');
    Route::post('store', 'LopController@store')->name('lop.store');
// cua ajax
    Route::get('lay-ten-khoa', 'LopController@getKhoaName')->name('lop.getkhoa');
    Route::get('lay-khoa-boi-nganh', 'LopController@getListNganh')->name('lop.getlistnganh');
    Route::post('update/{id}', 'LopController@update')->name('lop.update');
    Route::get('edit/{id}', 'LopController@edit')->name('lop.edit');
    Route::get('destroy/{id}', 'LopController@destroy')->name('lop.destroy');
});


Route::group(['prefix' => 'sinhvien'], function () {
    Route::get('index', 'SinhVienController@index')->name('sinhvien.index');
//them
    Route::get('create', 'SinhVienController@create')->name('sinhvien.create');
    Route::post('store', 'SinhVienController@store')->name('sinhvien.store');
    Route::get('destroy/{id}', 'SinhVienController@destroy')->name('sinhvien.destroy');
//sua
    Route::get('edit/{id}', 'SinhVienController@edit')->name('sinhvien.edit');
    Route::post('update/{id}', 'SinhVienController@update')->name('sinhvien.update');
//ajax
    Route::get('lay-ten-khoa', 'SinhVienController@getKhoaName')->name('lop.getkhoa');
    Route::get('lay-ten-Nganh', 'SinhVienController@getNganhName')->name('lop.getNganh');
    Route::get('lay-khoa-boi-nganh', 'SinhVienController@getListNganh')->name('lop.getlistnganh');
    Route::get('lay-lop-boi-nganh', 'SinhVienController@getListLop')->name('lop.getlistlop');
});

//search khoa
Route::get('search-khoa', 'KhoaController@search')->name('khoa.search');
///search nganh
Route::get('search-nganh', 'NganhController@search')->name('nganh.search');
///search lop
Route::get('search-lop', 'LopController@search')->name('lop.search');
///search sinh vien
Route::get('search-sinhvien', 'SinhVienController@search')->name('sinhvien.search');


// Login
Route::get('admin/login', 'SinhVienController@getLogin')->name('login.getlogin');
Route::post('admin-login', 'SinhVienController@postLogin')->name('login.postLogin');


//doi mat khau

Route::get('user/{id}/doi-mat-khau','SinhVienController@doimatkhau')->name('user.doimatkhau');
Route::post('user/{id}/doi-mat-khau-moi','SinhVienController@resetPasswd')->name('user.resetpasswd');

