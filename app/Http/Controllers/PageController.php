<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;
use App\Comment;

class PageController extends Controller
{	
	function __construct(){
			$theloai=TheLoai::all();
			$slide=Slide::all();
			view()->share('theloai',$theloai);
			view()->share('slide',$slide);
        

	}
    function trangchu(){
    
    	return view('pages.trangchu');

    }
    function lienhe(){
    	return view('pages.lienhe');
    }
     function loaitin($id){
     	$loaitin =LoaiTin::find($id);
     	$tintuc=TinTuc::where('idLoaiTin',$id)->paginate(5);

    	return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
     function tintuc($id){
     	$tintuc =TinTuc::find($id);
     	$tinnoibat=TinTuc::where('NoiBat',1)->take(4)->get();
     	$tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();

    	return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
    function getDangNhap(){
        return view('pages.dangnhap');
    }
    function postDangNhap(Request $request){
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
            return redirect('trangchu');
        }
        else{
            return redirect('dangnhap')->with('ThongBao','Đăng Nhập Không Thành Công');
        }

    }
    function getDangXuat(){
        Auth::logout();
     return redirect('trangchu');
    }
    function getNguoiDung(){
        $user=Auth::user();
        return view('pages.nguoidung',['user'=>$user]);
    }
    function postNguoiDung(Request $request){
        $this->validate($request,[

            'hoten'=>"required|min:4|max:20"
        ],[

            'hoten.required'=>'Bạn Chưa Nhập Tên',
            'hoten.min'=>'Độ Dài Tên Phải Lớn Hơn 3 Và Bé Hơn 20',
            'hoten.max'=>'Độ dài tên phải lớn hơn 3 và bé hơn 20'

        ]);

        $user=Auth::user();
        $user->name=$request->hoten;
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
        return redirect('nguoidung')->with('ThongBao','Đã Sửa Thành Công Tài Khoản');
    }
    function getDangKy(){
        return view('pages.dangky');
    }
    function postDangKy(Request $request){
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
        $user->quyen=0;
        $user->password=bcrypt($request->pass1);
        $user->save();
        return redirect('dangnhap')->with('ThongBao','Đăng Ký Thành Công Tài Khoản');
    }
    function postTimKiem(Request $request){

        $tukhoa=$request->tukhoa;
        $tintuc=TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%tukhoa%")->orWhere('NoiDung','like',"%tukhoa%")->paginate(6);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }

    function gioithieu(){
        return view('pages.gioithieu');
    }
}
