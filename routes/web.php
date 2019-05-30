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
 

Route::get('admin/dangnhap','usercontroller@getDangnhapadmin');
Route::post('admin/dangnhap','usercontroller@postDangnhapadmin');
Route::get('admin/dangxuat','usercontroller@getDangxuat');


Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){

	Route::group(['prefix'=>'theloai'],function(){
		Route::get('danhsach','theloaicontroller@getDanhSach');
		Route::get('sua/{id}','theloaicontroller@getSua');
		Route::post('sua/{id}','theloaicontroller@postSua');	
		Route::get('them','theloaicontroller@getThem');
		Route::get('xoa/{id}','theloaicontroller@getXoa');
		Route::post('them','theloaicontroller@postThem');
	});
	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danhsach','loaitincontroller@getDanhSach');
		Route::get('sua/{id}','loaitincontroller@getSua');
		Route::post('sua/{id}','loaitincontroller@postSua');	
		Route::get('them','loaitincontroller@getThem');
		Route::get('xoa/{id}','loaitincontroller@getXoa');
		Route::post('them','loaitincontroller@postThem');
	});
	Route::group(['prefix'=>'slide'],function(){
		Route::get('danhsach','slidecontroller@getDanhSach');
		Route::get('sua/{id}','slidecontroller@getSua');
		Route::post('sua/{id}','slidecontroller@postSua');	
		Route::get('them','slidecontroller@getThem');
		Route::get('xoa/{id}','slidecontroller@getXoa');
		Route::post('them','slidecontroller@postThem');
	});
	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('danhsach','tintuccontroller@getDanhSach');
		Route::get('sua/{id}','tintuccontroller@getSua');
		Route::post('sua/{id}','tintuccontroller@postSua');	
		Route::get('them','tintuccontroller@getThem');
		Route::post('them','tintuccontroller@postThem');	
		Route::get('xoa/{id}','tintuccontroller@getXoa');
		
	});
	Route::group(['prefix'=>'comment'],function(){
		Route::get('xoa/{id}/{idtintuc}','commentcontroller@getXoa');
	});
	Route::group(['prefix'=>'user'],function(){
		Route::get('danhsach','usercontroller@getDanhSach');
		Route::get('sua/{id}','usercontroller@getSua');
		Route::post('sua/{id}','usercontroller@postSua');	
		Route::get('them','usercontroller@getThem');
		Route::post('them','usercontroller@postThem');	
		Route::get('xoa/{id}','usercontroller@getXoa');
	});
	Route::group(['prefix'=>'ajax'],function(){
	Route::get('loaitin/{idLoaiTin}','ajaxcontroller@getLoaiTin');
	
	});
});
Route::get('trangchu','PageController@trangchu');
Route::get('lienhe','PageController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PageController@loaitin');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html','PageController@tintuc');
Route::get('dangnhap','PageController@getDangNhap');
Route::post('dangnhap','PageController@postDangNhap');
Route::get('dangxuat','PageController@getDangXuat');
Route::get('nguoidung','PageController@getNguoiDung');
Route::post('nguoidung','PageController@postNguoiDung');
Route::post('comment/{id}','commentcontroller@postComment');
Route::get('dangky','PageController@getDangKy');
Route::post('dangky','PageController@postDangKy');
Route::post('timkiem','PageController@postTimKiem');
Route::get('gioithieu','PageController@gioithieu');
