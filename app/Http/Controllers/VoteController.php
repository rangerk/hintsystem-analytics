<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use App\Translate;
//use App\User;
//use Illuminate\Support\Facades\Auth;

//use App\Vote;

class VoteController extends Controller
{

 /* public function __construct(){
    $this->middleware('auth');
  }*/

  public function reset($id){
    //request()->user()->votes()->delete();
    request()->user()->snippets->find($id)->votes()->delete();
    return redirect()->back();
  }
  
}

?>