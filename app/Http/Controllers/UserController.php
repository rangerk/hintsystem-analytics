<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function update()
    {
      request()->user()->update([
        'name' => request()->name,
        'nickname' => request()->nickname,
        'email' => request()->email,
        'password' => bcrypt(request()->password),
      ]);
    }
  
    public function valid()
    {
      return [
        'current' => password_verify(
          request()->current, 
          request()->user()->password),
        'password' => true,
        'confirm' => true,
      ];
    }
  
    public function one(){
      return [
        'email' => request()->user()->email,
      ];
    }
  
    public function reset($token){
      Auth::logout();
      return redirect('/password/reset/' . $token . '?email=' . request()->email);
    }
  
}
