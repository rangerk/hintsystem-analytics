<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Translate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Mail;

class MailController extends Controller
{

 /* public function __construct(){
    $this->middleware('auth');
  }*/
  
  public function reset(Request $request){
    //return 'hello';
    
    //return request()->token;
    //Auth::logout();
    $user = User::where('email', request()->email)->first();
    if (!$user){
      return redirect('/register');
    }
    $t = Password::getRepository()->create($user);
    //Auth::logout();
    
    //return redirect('/password/reset/'.$token.'?email='.$email);
    
    /*
    return view('auth.emails.password', [
       // 'user' => request()->user(),
     //   't' => new Translate(),
        'token' => $t,
        'email' => request()->email,
        'user' => $u,
    ]);
    */
    
    Mail::send('auth.emails.password', [
        'token' => $t,
        'email' => request()->email,
        'user' => $user,
      ], 
      function($m) use ($user) {
        $t = new Translate();
        //$m->from('roman@hintsystem.com', 'Roman Skaskiw');
        $m->from('no-reply@hintsystem.com', 'No Reply');
        $m->to($user->email, $user->name)->subject($t->translate('Hint System Password Reset'));
    });
    
    return redirect('/login');
  }
  
  /*
  
      Route::get('/password/nomail/reset', function() {
        if (!Auth::check()){
          return redirect('/login');
        }
        $token = Password::getRepository()->create( Auth::user() );
        $email = Auth::user()->email;
        Auth::logout();
        if (!$token || !$email) {
          return redirect('/login');
        } */
       /* return view('auth.passwords.reset')->with('token', $token)
          ->with('email', $email); */
    //    return redirect('/password/reset/'.$token.'?email='.$email);
   // });
  
  public function confirm(){
    /*
       $subject = 'Your Hintsystem password was recently changed', 
    */
   // return view('auth.emails.confirm');
    $user = Auth::user();
    Mail::send('auth.emails.confirm', [], function($m) use ($user){
      //$m->from('roman@hintsystem.com', 'Roman Skaskiw');
      $m->from('no-reply@hintsystem.com', 'No Reply');
      $m->to($user->email, $user->name)
        ->subject('Your Hintsystem password was recently changed');
    });
  }
  
  public function invite(){
    /*return view('auth.emails.invite', [
      'token' => request()->token,
      'account' => Auth::user()->account(),
    ]);*/
    /*if (!request()->email){
      return redirect()->back();
    }*/
    $user = Auth::user();
    Mail::send('auth.emails.invite', [
      'token' => request()->token,
      'account' => Auth::user()->account(),
    ], function($m) use ($user){
      $m->from('no-reply@hintsystem.com', 'No Reply');
      $m->to(request()->email, '')
        ->subject('Invitation to Hint Sytem');
    });
    //return redirect()->back();
  }
  
  public function welcome(){
    $user = Auth::user();
    Mail::send('auth.emails.welcome', [
      'user' => $user
    ], function($m) use ($user) {
      $t = new Translate();
      $m->from('no-reply@hintsystem.com', 'No Reply');
      $m->to($user->email, $user->name)
        ->subject($t->translate('Welcome to Hint System'));
    });
  }
  
}

?>