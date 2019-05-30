<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class indexcontroller extends Controller
{
	
   public function getIndex($id)

  {
  	$user=User::find($id);
  	return ('admin.layouts.index',['user'=>$user]);
  }
}

