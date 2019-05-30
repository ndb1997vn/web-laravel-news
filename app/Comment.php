<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table="comment";
    public function tintuc()
    {
    	return $this->belongsto('App\TinTuc','idtintuc','id');
    }
    public function user()
    {
    	return $this->belongsto('App\User','idUser','id');	
    }

}
