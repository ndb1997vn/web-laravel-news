<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;


class loaitincontroller extends Controller
{
	public function getDanhSach(){
		$loaitin = App\LoaiTin::all();
		return view('admin.loaitin.danhsach',['loaitin' => $loaitin]);

	}
	public function getSua($id){
		$loaitin=App\LoaiTin::find($id);
		return view('admin.loaitin.sua',['loaitin' => $loaitin]);


		
	}
	public function postSua(request $request,$id)
	{
		$loaitin=App\LoaiTin::find($id);
		$this->validate($request,
			[
				"Ten"=>'required|unique:loaitin,Ten|min:3|max:100'
			],
			[
				"Ten.required"=>" Bạn Chưa Nhập Tên Thể Loại",
				'Ten.min'=>'Số Ký Tự Phải Lớn Hơn 3 và Nhỏ Hơn 100',
				'Ten.max'=>'Số Ký Tự Phải Lớn Hơn 3 và Nhỏ Hơn 100',
				'Ten.unique'=>'Tên Thể Loại Đã Có'

			]
		);
		$loaitin->Ten=$request->Ten;
		$loaitin->TenKhongDau=changeTitle($request->Ten);
		$loaitin->save();
		return redirect('admin/loaitin/sua/'.$id)->with('Thongbao','Bạn Đã Sửa Thành Công');


		
	}
	public function getThem(){
			$theloai=App\TheLoai::all();
		return view('admin.loaitin.them',['theloai' => $theloai]);
	}

	
	

	public function postThem(Request $request)
	{
	

			$this->validate($request,
			[
				'Ten'=> 'required|min:3|max:100',
				'TheLoai'=>'required'
			],
			[	
				'TheLoai.required'=>'Bạn Chưa Chọn Thể Loại',
				'Ten.required'=>'Bạn Chưa Nhập Tên Loại Tin',
				'Ten.min'=>'Số Ký Tự Phải Lớn Hơn 3 và Nhỏ Hơn 100',
				'Ten.max'=>'Số Ký Tự Phải Lớn Hơn 3 và Nhỏ Hơn 100',
			

			]);

			$loaitin = new App\LoaiTin;
			$loaitin->Ten= $request->Ten;
			$loaitin->TenKhongDau = changeTitle($request ->Ten);
			$loaitin->idtheloai=$request->TheLoai;
			$loaitin->save();
			return redirect('admin/loaitin/them')->with('ThongBao','Thêm Thành Công');

			

		
	}
	public function getXoa($id){

		$loaitin = App\LoaiTin::find($id);
		$loaitin -> delete();
		return redirect('admin/loaitin/danhsach')->with('Thongbao','Đã Xóa Thành Công');
	}
  
}

