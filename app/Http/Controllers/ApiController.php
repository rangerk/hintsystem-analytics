<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Snippet;
use App\Repositories\SnippetRepository;
use App\User;
use App\Vote;
use App\Translate;

use Config;
use App\Account;

class ApiController extends Controller
{
    /**
     * The repository instance.
     */
    protected $snippets;

    /**
     * Create a new controller instance.
     */
    public function __construct(SnippetRepository $snippets)
    {
       // $this->middleware('auth');

        $this->snippets = $snippets;
      
        Config::set('database.default', 'mysql2');
    }
  
    public function show($user, $hint){
        $this->middleware('guest');
        // Config::set('database.default', 'mysql2');
        return response()->json( [
                //'snippet' => Snippet::where('user_id', $user)->where('num', $hint)->first(),
                'snippet' => Snippet::where('account_id', $user)->where('num', $hint)->first(),
                /*
                'domains' => User::find($user)->domains,
                'test' => User::find($user)->test,
                'voting' => User::find($user)->voting,
                'translate' => Translate::all(),
                'selected' => User::find($user)->translate,
                */
                'domains' => Account::find($user)->domains,
                'test' => Account::find($user)->test,
                'voting' => Account::find($user)->voting,
                'translate' => Translate::all(),
                'selected' => Account::find($user)->translate,
          
                'onoff' => Account::find($user)->onoff,
          
            ])
            ->withHeaders([
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => '*',
                'Access-Control-Allow-Headers' => '*',
            ]);
    }
  
  public function vote(){
    Vote::updateOrCreate([
      'token' => request()->token,
      'snippet_id' => request()->snippet_id
      ], [
      //'token' => request()->token,
      //'snippet_id' => request()->snippet_id,
      'value' => request()->value
    ]);
  }
  
  public function dragdrop(){
    //return 'hello';
    
    return view('snippets.dragdrop', [
      'snippets' => request()->user()->snippets()->get() //Snippet::all()
      //'snippets' => request()->user()->account()->snippets()->get()
    ]);
    
  }
  
}
