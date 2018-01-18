<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use App\Translate;
use App\User;
//use Illuminate\Support\Facades\Auth;

//use App\Vote;

class ValidateController extends Controller
{

 /* public function __construct(){
    $this->middleware('auth');
  }*/
/*
  public function reset($id){
    //request()->user()->votes()->delete();
    request()->user()->snippets->find($id)->votes()->delete();
    return redirect()->back();
  }*/
  
  public function valid(){
    //  $this->middleware('guest');
   // return 'hello';
    $u = User::where('email', request()->email)->first();
  //  $p = $u ? $u->password == bcrypt(request()->password) : null;
    
    return [
      'email' => $u ? true : null,
      'password' => password_verify(request()->password, $u ? $u->password : null), //$p ? true : null,
    ];
  }
  
}

?>