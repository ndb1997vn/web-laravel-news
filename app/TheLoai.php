<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table="theloai";
    public function loaitin()
    {
    	return $this->hasMany('App\Loaitin','idTheLoai','id');
    }
    public function tintuc()
    {
    	return $this->hasManyThrough('App\TinTuc','App\Loaitin','idTheLoai','idLoaiTin','id');
    }

}
