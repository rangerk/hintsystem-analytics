<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Translate;
//use App\User;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class TranslateController extends Controller
{

 /* public function __construct(){
    $this->middleware('auth');
  }*/

  public function index(Request $request){
    
    /*return [
        '1' => '2',
        '3' => '4',
        'Hint System' => 'Hint System (test2)'
    ];*/
    //$t = 'Welcome to Hint System';
   // $t = 'Thanks for trying Hint System';
      //$t = 'Our goal is to give documentation writers and UX';
//<br />
     // $t = 'specialists direct control over';
//<strong>
       // $t = 'in context';
//</strong> 
//$t = 'help and user assistant';


//$t = 'If you have any question or comments';
//$t = 'please let me know';
//<br />
//<br />
//$t = 'Sincerely';

    //$t = 'Click here to reset your password';
   // $t = 'saved';
   // $t = 'copied';
   // $t = 'Hint System Password Reset';
    //$t = 'the Hint System Team';
    //$t = 'We\'re just letting you know';
    //$t = 'If you\'re aware of this, no problem';
    //$t = 'If not, you may want to look into it';
   // $t = 'Kind regards';
    /*$t = 'the Hint System Team';
    Translate::create([
      'key' => $t,
      //'en' => $t . ' en',
      'en' => $t,
      'test' => $t . ' test',
    ]);*/
    /*
    foreach(Translate::all() as $t){
      Translate::where('id', $t->id)->update([
        'en' => $t->key,
      ]);
    }
    */

    if ($request->user()){
      return [
        'values' => Translate::all(),
        'selected' => $request->user()->translate
      ];
    }
    return [ 'values' => Translate::all() ];
  }

  public function add(){
    $t = request()->value;
    return Translate::create([
      'key' => $t,
     // 'en' => $t . ' en',
      'en' => $t,
      'test' => $t . ' test',
    ]);
  }
  
  public function select(Request $request, $value){
    //User::where('translate', '')->update([ 'translate' => 'en' ]);
    
    $request->user()->translate = $value;
    $request->user()->save();
    
    Artisan::call('view:clear');
    
    return redirect()->back();
  }
  
}

?>