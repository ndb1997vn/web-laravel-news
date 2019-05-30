<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\User;


class usercontroller extends Controller
{

	public function getDanhSach()
	{
		$user=User::all();
		return view('admin/user/danhsach',['user'=>$user]);
	}



	public function getThem(){
		return view('admin.user.them');

	}

	public function postThem(Request $request){
		$this->validate($request,[

			'hoten'=>"required|min:4|max:20",
			'email'=>"required|email|unique:users,email",
			'pass'=>"required|min:8",
			'pass1'=>"required|same:pass"
		],[

			'hoten.required'=>'Bạn Chưa Nhập Tên',
			'hoten.min'=>'Độ Dài Tên Phải Lớn Hơn 3 Và Bé Hơn 20',
			'hoten.max'=>'Độ dài tên phải lớn hơn 3 và bé hơn 20',
			'email.required'=>"Bạn Chưa  Nhập Email",
			'email.unique'=>'Email Đã Được Đắng Ký',
			'email.email'=>"Chưa Đúng Định Dạng Email",
			'pass.required'=>"Bạn Chưa Nhập PassWord",
			'pass1.required'=>"Bạn Chưa Nhập Lại PassWord",
			'pass1.same'=>"2 PassWord Không Giống Nhau",
			'pass.min'=>"Độ Dài PassWord Phải Dài Hơn 8 Ký Tự"

		]);

		$user=new User;
		$user->name=$request->hoten;
		$user->email=$request->email;
		$user->quyen=$request->permission;
		$user->password=bcrypt($request->pass1);
		$user->save();
		return redirect('admin/user/them')->with('ThongBao','Đã Thêm Thành Công tài Khoản');

	}

	public function getSua($id){
		$user=User::find($id);

		return view('admin.user.sua',['user'=>$user]);

	}
	public function postSua(Request $request,$id){
		$this->validate($request,[

			'hoten'=>"required|min:4|max:20"
		],[

			'hoten.required'=>'Bạn Chưa Nhập Tên',
			'hoten.min'=>'Độ Dài Tên Phải Lớn Hơn 3 Và Bé Hơn 20',
			'hoten.max'=>'Độ dài tên phải lớn hơn 3 và bé hơn 20'

		]);

		$user=User::find($id);
		$user->name=$request->hoten;
		$user->quyen=$request->permission;
		if(($request->changepass)=="on")
		{
			$this->validate($request,[

		
			'pass'=>"required|min:8",
			'pass1'=>"required|same:pass"
		],[

			'pass.required'=>"Bạn Chưa Nhập PassWord",
			'pass1.required'=>"Bạn Chưa Nhập Lại PassWord",
			'pass1.same'=>"2 PassWord Không Giống Nhau",
			'pass.min'=>"Độ Dài PassWord Phải Dài Hơn 8 Ký Tự"

		]);
				$user->password=bcrypt($request->pass1);
		}
		
	
		$user->save();
		return redirect('admin/user/sua/'.$id)->with('ThongBao','Đã Sửa Thành Công tài Khoản');

	}
	public function getXoa($id)
	{
		$user=User::find($id);
		$user->delete();
		return redirect('admin/user/danhsach')->with('ThongBao',"Bạn Đã Xóa Thành Công");
	}
	public function getDangnhapadmin()
	{
		return view('admin.login');

	}
	public function postDangnhapadmin(Request $request){
	$this->validate($request,[
		'email'=>'required|email|min:3',
		'password'=>'required|min:3'
	],[
		'email.required'=>"Bạn Chưa Nhập Email",
		'password.required'=>"Bạn Chưa Nhập PassWord",
		'email.min'=>"Email Phải Có Ít Nhất 3 Ký Tự",
		'password.min'=>"PassWord Phải Có Ít Nhất 3 Ký Tự",
		'email.email'=>"Chưa Đúng Định Dạng Email"

	]);
	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
	 {
	 	
	 	return redirect('admin/theloai/danhsach');
	 }
	 else{
	 	return redirect('admin/dangnhap')->with('ThongBao','Đăng Nhập Thất Bại');
	 }
}
    public function getDangxuat(){
	    Auth::logout();
	    return redirect('admin/dangnhap');
    }

}