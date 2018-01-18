<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
//use App\Translate;
use App\User;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Password;

class LogController extends Controller
{

 /* public function __construct(){
    $this->middleware('auth');
  }*/
  
  public function add(){
    //Storage::append('log1.log', time() . ' - 1');
    //$p = storage_path('logs') . '/log1.log';
    $p = storage_path('logs') . '/log2.log';
    $u = request()->user() ? request()->user()->id : 'guest';
    if (request()->token){
      $u = User::where('remember_token', request()->token)->first()->id;
    }
    $snippet_id = request()->snippet_id;
    
    file_put_contents($p, (request()->value).','.(request()->created_at.','.request()->url.','.$u.','.$snippet_id).PHP_EOL, FILE_APPEND | LOCK_EX);
    return 'hello';
  }
  
  public function api(){
    $p = storage_path('logs') . '/api.log';
    $created_at = date('y/m/d h:m:s');
    file_put_contents(
      $p, 
      request()->url.','
        .$created_at.','
        .request()->snippet_id.','
        .request()->value
        .PHP_EOL, 
      FILE_APPEND);
  }

  public function account(){
    $p = storage_path('logs') . '/account.log';
    $created_at = date('y/m/d h:m:s');
    file_put_contents(
      $p, 
        request()->value
        .','
        .$created_at
        .','
        .request()->user()->id
        .','
        .request()->snippet_id
        .PHP_EOL, 
      FILE_APPEND);
  }
}

?>