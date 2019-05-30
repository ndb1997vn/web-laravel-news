<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;


class theloaicontroller extends Controller
{
	public function getDanhSach(){
		$theloai = TheLoai::all();
		return view('admin.theloai.danhsach',['theloai' => $theloai]);

	}
	public function getSua($id){
		$theloai=TheLoai::find($id);
		return view('admin.theloai.sua',['theloai'=>$theloai]);

	}
	public function postSua(request $request,$id)
	{
		$theloai=TheLoai::find($id);
		$this->validate($request,
			[
				"Ten"=>'required|unique:theloai,Ten|min:3|max:100'
			],
			[
				"Ten.required"=>" Bạn Chưa Nhập Tên Thể Loại",
				'Ten.min'=>'Số Ký Tự Phải Lớn Hơn 3 và Nhỏ Hơn 100',
				'Ten.max'=>'Số Ký Tự Phải Lớn Hơn 3 và Nhỏ Hơn 100',
				'Ten.unique'=>'Tên Thể Loại Đã Có'

			]
		);
		$theloai->Ten=$request->Ten;
		$theloai->TenKhongDau=changeTitle($request->Ten);
		$theloai->save();
		return redirect('admin/theloai/sua/'.$id)->with('Thongbao','Bạn Đã Sửa Thành Công');


		
	}
	public function getThem()
	{
	$theloai=TheLoai::all();
	return view('admin.theloai.them',['theloai'=>$theloai]);		
	}

	public function postThem(Request $request)
	{
	

			$this->validate($request,
			[
				'Ten'=> 'required|min:3|max:100'
			],
			[
				'Ten.required'=>'Ban chua nhap ten the loai',
				'Ten.min'=>'Số Ký Tự Phải Lớn Hơn 3 và Nhỏ Hơn 100',
				'Ten.max'=>'Số Ký Tự Phải Lớn Hơn 3 và Nhỏ Hơn 100'

			]);

			$theloai = new TheLoai;
			$theloai->Ten= $request->Ten;
			$theloai->TenKhongDau = changeTitle($request ->Ten);
			$theloai->save();
			return redirect('admin/theloai/them')->with('ThongBao','Thêm Thành Công');

			

		
	}
	public function getXoa($id){

		$theloai = TheLoai::find($id);
		$theloai -> delete();
		return redirect('admin/theloai/danhsach')->with('Thongbao','Đã Xóa Thành Công');
	}
  
}

