<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;

class tintuccontroller extends Controller
{
    
 


	public function getDanhSach(){
		$tintuc = TinTuc::orderBy('id','DESC')->get();
		return view('admin.tintuc.danhsach',['tintuc' => $tintuc]);

	}	
	public function getSua($id){
		$tintuc=TinTuc::find($id);
		$loaitin=LoaiTin::all();
		$theloai=TheLoai::all();

		return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);

	}
	public function postSua(request $request,$id)
	{
		$tintuc=TinTuc::find($id);
		$this->validate($request,[
			'LoaiTin'=>'required',
			'TieuDe'=>'required|min:3|',
			'TomTat'=>'required',
			'NoiDung'=>'required'
			],[
				'LoaiTin.required'=>'Bạn Chưa Nhập Nội Dung Loai Tin',
				'TomTat.required'=>'Bạn Chưa Nhập Nội Dung TomTat',
				'TieuDe.required'=>'Bạn Chưa Nhập Nội Dung TieuDe',
				'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung NoiDung',
				'TieuDe.min'=>'Nội Dung Phải Lớn Hơn 3 Ký Tự Và Bé Hơn 200 Ký Tự',
				'TieuDe.unique'=>'Tiêu Đề Đã Tồn Tại'

			]);
		$tintuc->TieuDe=$request->TieuDe;
		$tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
		$tintuc->idLoaiTin=$request->LoaiTin;
		$tintuc->TomTat=$request->TomTat;
		$tintuc->NoiDung=$request->NoiDung;
		$tintuc->SoLuotXem=0;

		if($request->hasfile('Hinh')){
			$file=$request->file('Hinh');
			$duoi=$file->getClientOriginalextension();
			if($duoi != 'jpg' && $duoi!='png' ){
				return redirect("admin/tintuc/sua")->with('loi','Chỉ Được Phép Chọn Ảnh');

			}
			$name=$file->getClientOriginalName();
			$Hinh=str_random(4)."_".$name;
			$file->move("upload/tintuc",$Hinh);

			$tintuc->Hinh=$Hinh;

		}
		
		
		$tintuc->save();
		return redirect("admin/tintuc/sua/".$id)->with('ThongBao','Sửa Tin Tức Thành Công');


		
	}
	public function getThem()
	{
		$theloai=TheLoai::all();
		$loaitin=LoaiTin::all();
	return view('admin.tintuc.them',["theloai"=>$theloai,"loaitin"=>$loaitin                                                             ]);
	}

	public function postThem(Request $request)
	{
	
		$this->validate($request,[
			'LoaiTin'=>'required',
			'TieuDe'=>'required,TieuDe',
			'TomTat'=>'required',
			'NoiDung'=>'required'
			],[
				'LoaiTin.required'=>'Bạn Chưa Nhập Nội Dung Loai Tin',
				'TomTat.required'=>'Bạn Chưa Nhập Nội Dung TomTat',
				'TieuDe.required'=>'Bạn Chưa Nhập Nội Dung TieuDe',
				'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung NoiDung',
				'TieuDe.min'=>'Nội Dung Phải Lớn Hơn 3 Ký Tự Và Bé Hơn 200 Ký Tự',
				'TieuDe.unique'=>'Tiêu Đề Đã Tồn Tại'

			]);
		$tintuc= new TinTuc;
		$tintuc->TieuDe=$request->TieuDe;
		$tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
		$tintuc->idLoaiTin=$request->LoaiTin;
		$tintuc->TomTat=$request->TomTat;
		$tintuc->NoiDung=$request->NoiDung;
		$tintuc->SoLuotXem=0;

		if($request->hasfile('Hinh')){
			$file=$request->file('Hinh');
			$duoi=$file->getClientOriginalextension();
			if($duoi != 'jpg' && $duoi!='png' ){
				return redirect("admin/tintuc/them")->with('loi','Chỉ Được Phép Chọn Ảnh');

			}
			$name=$file->getClientOriginalName();
			$Hinh=str_random(4)."_".$name;
			$file->move("upload/tintuc",$Hinh);
			$tintuc->Hinh=$Hinh;

		}
		else{
			$tintuc->Hinh="";
		}
		$tintuc->save();
		return redirect("admin/tintuc/them")->with('ThongBao','Thêm Tin Tức Thành Công');

			

		
	}
	public function getXoa($id){

		$tintuc = TinTuc::find($id);
		$tintuc -> delete();
		return redirect('admin/tintuc/danhsach')->with('Thongbao','Đã Xóa Thành Công');
	}
  
}




