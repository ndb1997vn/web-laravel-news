<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comment;
use App\TinTuc;


class commentcontroller extends Controller
{
	public function getXoa($id,$idTinTuc){

		$comment = Comment::find($id);
		$comment -> delete();
		return redirect("admin/tintuc/sua/".$idTinTuc)->with('ThongBao1','Xóa Commnet Thành Công');
	}


	   public function postComment($id,Request $request){
        $idTinTuc=$id;
        $tintuc=TinTuc::find($id);
        $Comment = new Comment;
        $Comment->idTinTuc=$idTinTuc;
        $Comment->idUser=Auth::user()->id;
        $Comment->NoiDung=$request->NoiDung;
        $Comment->save();
        return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('ThongBao','Viết Bình Luận Thành Công');
        
    }
  
}

