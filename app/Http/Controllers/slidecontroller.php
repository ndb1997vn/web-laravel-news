<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class slidecontroller extends Controller
{
    
 


	public function getDanhSach()
	{
	$slide=Slide::all();

	return view('admin.slide.danhsach',['slide'=>$slide]);
	}
	public function getSua($id){
	$slide=Slide::find($id);

	return view('admin.Slide.sua',['slide'=>$slide]);

	}
	public function postSua(request $request,$id)
	{
		$this->validate($request,[
			'Ten'=>'required|min:3|unique:slide',
			'NoiDung'=>'required'
			],[
				'Ten.required'=>'Bạn Chưa Nhập Tên',
				'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung NoiDung',
				'Ten.min'=>'Nội Dung Phải Lớn Hơn 3 Ký Tự Và Bé Hơn 200 Ký Tự',
				'Ten.unique'=>'Tên Đề Đã Tồn Tại'

			]);
		$slide= new Slide;
		$slide->Ten=$request->Ten;

			if($request->hasfile('Hinh')){
			$file=$request->file('Hinh');
			$duoi=$file->getClientOriginalextension();
			if($duoi != 'jpg' && $duoi!='png' ){
				return redirect("admin/slide/them")->with('loi','Chỉ Được Phép Chọn Ảnh');

			}
			$name=$file->getClientOriginalName();
			$Hinh=str_random(4)."_".$name;
			$file->move("upload/slide",$Hinh);
			$slide->Hinh=$Hinh;

		}
		else{
			$slide->Hinh="1.jpg";
		}
		$slide->NoiDung=$request->NoiDung;
		if($request->has('link'))

		$slide->link=$request->link;


		
		$slide->save();
		return redirect("admin/slide/sua/".$id)->with('ThongBao','Sửa Slie Thành Công');


		
	}
	public function getThem(){
		$slide=Slide::all();
		return view('admin.slide.them',['slide' => $slide]);
	}
	public function postThem(Request $request)
	{
		$this->validate($request,[
			'Ten'=>'required|min:3|unique:slide',
			'NoiDung'=>'required'
			],[
				'Ten.required'=>'Bạn Chưa Nhập Tên',
				'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung NoiDung',
				'Ten.min'=>'Nội Dung Phải Lớn Hơn 3 Ký Tự Và Bé Hơn 200 Ký Tự',
				'Ten.unique'=>'Tên Đề Đã Tồn Tại'

			]);
		$slide= new Slide;
		$slide->Ten=$request->Ten;

			if($request->hasfile('Hinh')){
			$file=$request->file('Hinh');
			$duoi=$file->getClientOriginalextension();
			if($duoi != 'jpg' && $duoi!='png' ){
				return redirect("admin/slide/them")->with('loi','Chỉ Được Phép Chọn Ảnh');

			}
			$name=$file->getClientOriginalName();
			$Hinh=str_random(4)."_".$name;
			$file->move("upload/slide",$Hinh);
			$slide->Hinh=$Hinh;

		}
		else{
			$slide->Hinh="1.jpg";
		}
		$slide->NoiDung=$request->NoiDung;
		if($request->has('link'))

		$slide->link=$request->link;


		
		$slide->save();
		return redirect("admin/slide/them")->with('ThongBao','Thêm Tin Tức Thành Công');
	}
	public function getXoa($id)
	{
		$slide=Slide::find($id);
		$slide->delete();
		return redirect('admin/slide/danhsach')->with('ThongBao','Đã Xóa Thành Công');
	}
  
}




