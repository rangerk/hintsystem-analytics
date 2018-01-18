<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
//use App\Account;
use App\Url;
use App\Invite;

class AdminController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
      return view('admins.show', [
          'users' => User::all(),
      ]);
    }
  
    public function accounts($user_id){
      return view('admins.accounts', [
        'accounts' => User::find($user_id)->accounts()->get(),
        'user' => User::find($user_id),
        'invites' => Invite::where('email', User::find($user_id)->email)
          ->orderBy('role', 'asc')
          ->orderBy('status', 'asc')
          ->get(),
      ]);
    }
  
    public function login(){
      return view('admins.login', [
        //
      ]);
    }
  
    public function options(){
      return view('admins.options', [
        'urls' => Url::orderBy('created_at', 'desc')->first(),
        //
      ]);
    }
  
    public function save(){
      request()->user()->urls()->create([
        'dragdrop' => request()->dragdrop,
        'hs' => request()->hs,
        'api' => request()->api,
        'log' => request()->log,
      ]);
      return redirect()->back();
    }
  
    public function test(){
      return view('admins.test');
    }
}
