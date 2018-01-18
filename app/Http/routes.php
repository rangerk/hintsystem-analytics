<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
      
Route::group(['middleware' => ['web']], function () {
      
    Route::get('/', function () {
        
      return redirect('/login');
    })->middleware('guest');
    Route::get('/home', function (){
        return redirect('/login');
      
    });
 
    Route::auth();
      
    Route::get('/password/nomail/reset', function() {
        if (!Auth::check()){
          return redirect('/login');
        }
        $token = Password::getRepository()->create( Auth::user() );
        $email = Auth::user()->email;
        Auth::logout();
        if (!$token || !$email) {
          return redirect('/login');
        }
       /* return view('auth.passwords.reset')->with('token', $token)
          ->with('email', $email); */
        return redirect('/password/reset/'.$token.'?email='.$email);
    }); 
  
    
  
    Route::get('/tokens/create', 'TokenController@create');
    Route::get('/tokens/delete', 'TokenController@remove');
    Route::get('/tokens/save', 'TokenController@save');
  
    Route::get('/admins/show', 'AdminController@show');
    Route::get('/admins/accounts/{user}', 'AdminController@accounts');
    Route::get('/admins/login', 'AdminController@login');
    Route::get('/admins/options', 'AdminController@options');
    Route::get('/admins/options/save', 'AdminController@save');
  
    Route::get('/api/token', 'TokenController@token');
  
    Route::get('/admins/test', 'AdminController@test');
    
});

Route::get('/api/login', 'TokenController@login');
Route::post('/api/login', 'TokenController@login');
Route::get('/reset/{token}', 'UserController@reset');







