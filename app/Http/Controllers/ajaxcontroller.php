<?php

namespace App\Http\Controllers;
use App\LoaiTin;
use App\Theloai;


use Illuminate\Http\Request;

class ajaxcontroller extends Controller
{
    public function getLoaiTin($idTheLoai){
    	$loaitin=LoaiTin::where('idTheloai',$idTheLoai)->get();
    	foreach ($loaitin as $lt) {
    		echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
    	}	
    }
}
