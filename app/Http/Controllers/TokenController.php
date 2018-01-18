<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Token;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TokenController extends Controller
{
    public function create(){
      return Token::create([
        'token' => request()->token,
        'user_id' => request()->user()->id,
        'account_id' => request()->user()->account()->id,
      ]);
    }
  
    public function remove(){
      return Token::where('token', request()->token)->delete();
    }
  
    public function login(){
     // Token::where('token', '!=', '')->delete();
      /*$hours = (new \DateTime(date('Ymd')))->diff( new \DateTime( $t->updated_at))->hours;
      if ($hours > 1){
        // remove tokens
      }*/
      
      if (Auth::attempt([
        'email' => request()->email,
        'password' => request()->password
      ])){
        return Token::create([
          'token' => Session::token(),
          'user_id' => Auth::user()->id,
          'account_id' => Auth::user()->account()->id,
        ]);
      }
      
      return response('Auth failed', 500);
    }
  
    public function token(){
      return Session::token();
    }
  
    public function save(){
    //  return Token::create([
      Token::create([
        'token' => Session::token(),
        'user_id' => request()->user()->id,
        'account_id' => request()->user()->account()->id,
      ]);
      // return redirect('/');
      return redirect('/admins/show');
    }
  
}
