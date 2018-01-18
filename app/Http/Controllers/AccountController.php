<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\SnippetRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

use App\Translate;
use App\Account;
use App\Snippet;
use App\Invite;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(){
        return view('accounts.edit', [
          // 'user' => request()->user(),
          'account' => request()->user()->account(),
          'role' => request()->user()->account()
            ->invites()->where('email', request()->user()->email)->first() ?
              'owner' : 'regular',
        ]);
    }
        
    public function save(){
      /*
        request()->user()->domains = request()->domains;
        request()->user()->test = request()->test;
        request()->user()->voting = request()->voting;
        request()->user()->columns = request()->columns;
        request()->user()->max = request()->max;
        request()->user()->save();
        */
        //return redirect('/');
       // User::where('voting', '')->update(['voting' => 'on']);
        /*
        request()->user()->account()->domains = request()->domains;
        request()->user()->account()->test = request()->test;
        request()->user()->account()->voting = request()->voting;
        request()->user()->account()->columns = request()->columns;
        request()->user()->account()->max = request()->max;
        request()->user()->account()->save();
        */
      
        request()->user()->account()->update([
          'domains' => request()->domains,
          'test' => request()->test,
          'voting' => request()->voting,
          'columns' => request()->columns,
         // 'max' => request()->max,
          
          'nickname' => request()->nickname,
          'onoff' => request()->onoff,
        ]);
        /* Account::where('max', 0)->update([
          'max' => 7
        ]); */
    }
  
    /*public function delete(){
        return view('accounts.delete');
    }*/
  
    public function destroy($id){
    //    Auth::logout();
        $user = User::find($id);
        $user->snippets()->delete();
        $user->accounts()->get()->map(function($a){
          $a->invites()->delete();
        });
        $user->accounts()->delete();
        $user->delete();
        Auth::logout();
        //return redirect('/');
    }
  
    public function import(Request $request){
        
        if (!$request->options){
            return redirect('/account/edit')->with([
                'message' => 'Please select options'
            ]);
        }
        if (!$request->hasFile('f')){
            return redirect('/account/edit')->with([
                'message' => 'Please select file'
            ]);
        }
        $path = $request->file('f')->path();
        
      /*
        $u = Auth::loginUsingId(2);
        if (!$u){
          return response('Error');
        }
        $path = storage_path('e5.csv');
      */
      
        // $path = $request->f->store('import'); 
        // $path = $request->f->store('.'); 
    
        $f = fopen($path, 'r');
        $line = null;
        $keys = null;
        $all = $request->user()->snippets();
        if ($request->options == 'replace'){
          $all->delete();
        }
        while ($line = fgetcsv($f)){
            if (!$keys){
                $keys = $line;
                continue;
            } else {
                $line = array_combine($keys, $line);
            }
            
            $s = null;
            if ($request->options == 'replace'){
              $s = $all->create([]);
              $s->num = $request->user()->snippets()->max('num') + 1;
            }
            if ($request->options == 'merge'){
              $s = $all->find($line['id']);
              if (!$s){
                $s = $all->create([]);
                $s->num = $request->user()->snippets()->max('num') + 1;
              } else {
                $s = null;
              }
            }
            if ($request->options == 'append'){
              $s = $all->create([]);
              $s->num = $request->user()->snippets()->max('num') + 1;
            }
            
            if ($s){
              $s->update([
                'content' => $line['content'],
                'snippet' => '',
                'nickname' => $line['nickname'],
               // 'num' => $request->user()->snippets()->max('num') + 1,
                //'num' => $all->max('num') + 1,
                
                'on' => $line['on'],
                'tags' => $line['tags'],
                'header' => $line['header'],
                'footer' => $line['footer'],
                'activation' => $line['activation'],
                'icon' => $line['icon'],
                'type' => $line['type'],
                'icons' => $line['icons'],
              ]);

              $sr = new SnippetRepository();
              $s->snippet = $sr->generate($s->id);
              $s->save();
            }
        }
        //return redirect('/');
    }
  
    public function export(){
      /*
      $u = Auth::loginUsingId(2);
      if (!$u){
        return response('Error');
      }
      */
      
        $data= request()->user()->snippets();
        $keys = array_keys($data->first()->toArray());
        $cb = function() use ($data, $keys) {
              $f = fopen('php://output', 'w');
         // var_dump( storage_path('export.csv') );
            //  $f = fopen(storage_path('export.csv'), 'w+');
              fputcsv($f, $keys);
              $data->each( function($row, $key) use ($f) {
                  fputcsv($f, $row->toArray());
              });
              fclose($f);
        };
        return response()->stream($cb, 200, [
              'Content-Disposition' => 'attachment; filename="export.csv"',
              'Cache-control' => 'private',
            //  'Content-type' => 'application/force-download',
              'Content-type' => 'text/csv; charset=utf-8',
              'Content-transfer-encoding' => 'binary\n',
        ]);
    }
  
    public function icons(Request $request){
      $this->middleware('guest');
      return response('Hello');
    }
  
    public function tab(){
      //User::where('tab', '')->update([ 'tab' => 'settings' ]);
      request()->user()->tab = request()->value;
      request()->user()->save();
     // return request()->user();
    }
  
    public function mail(){
      return view('auth.emails.welcome', [
        'user' => request()->user(),
    //    't' => new Translate()
      ]);
    }
  
    public function reset(){
      $this->middleware('guest');
      return request()->token;
      /*
      return view('auth.emails.reset', [
        'user' => request()->user(),
     //   't' => new Translate(),
        'token' => $token,
        'email' => request()->email
      ]);
      */
    }
  
    public function valid(){
      $this->middleware('guest');
      return 'hello';
    }
  
    public function settings(){
        return view('accounts.settings');
    }
  
    public function accounts(){
        return view('accounts.billing');
    }
  
    public function add(){
        //$u = User::where('email', request()->email)->first();
        return Account::create([
          'user_id' => request()->user()->id,
          //'user2_id' => $u->id,
          'nickname' => request()->nickname ?: 'New Account',
          
          'domains' => request()->user()->domains,
          'counter' => request()->user()->counter,
          'test' => request()->user()->test,
          'icons' => request()->user()->icons,
          'translate' => request()->user()->translate,
          'tab' => request()->user()->tab,
          'voting' => request()->user()->voting,
          'columns' => request()->user()->columns,
          'max' => request()->user()->max,
          
          'onoff' => 'on',
          
        ]);
    }
  
    public function index(){
      //Snippet::where('id', '>', 0)->delete();
      //Account::where('id', '>', 0)->delete();
      
      //return request()->user()->accounts()->get();
      return [
        'accounts' => request()->user()->accounts()->get(),
        'account' => request()->user()->account(),
        'invites' => Invite::where('email', request()->user()->email)
          ->where('status', 'pending')->get(),
      ];
    }
  
    public function remove(){
      $a = request()->user()->accounts()->find(request()->id);
      $a->snippets()->delete();
      $a->invites()->delete();
      $a->delete();
    }
  
    public function select(){
      request()->user()->select(request()->id);
      return redirect()->back();
    }
  
    public function current(){
      return request()->user()->account();
    }
  
    public function clear($id){
      $a = request()->user()->accounts()->find($id);
      $a->snippets()->delete();
      $a->invites()->delete();
      $a->delete();
      
      return redirect('/accounts');
    }
  
    public function transfer($id){
      $a = request()->user()->accounts()->find($id);
      $u = User::where('email', request()->email)->first();
      //$u->accounts()->create($a);
      //$a->delete();
      $a->update([
        'user_id' => $u->id,
      ]);
      
      //return redirect('/accounts');
    }
  
    public function quit(){
      request()->user()->select(0);
      return redirect('/accounts');
    }
  
    public function find(){
      // return request()->user()->account()->invites()->get();
      return Invite::where('email', request()->email)
        ->where('user_id', request()->user()->id)->get();
    }
  
    public function change($id){
      request()->user()->select($id);
      return redirect('/account/edit');
    }
  
    public function join($id){
      $a = Account::find($id)->replicate();
      $a->user_id = request()->user()->id;
      $a->save();
      return $a;
    }

}
