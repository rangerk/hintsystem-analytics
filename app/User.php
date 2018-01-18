<?php

namespace App;

use App\Snippet;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Vote;
use App\Position;
use App\Account;
use App\Url;

class User extends Authenticatable
{

   // use SoftDeletes;

   // protected $dates = ['deleted_at'];
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'domains', 'test', 'translate', 'nickname',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //protected $account = null;
  
    /**
     * Get all of the tasks for the user.
     */
    public function snippets()
    {
        return $this->hasMany(Snippet::class);
    }
  
    public function votes(){
      return Vote::whereIn(
        'snippet_id', 
        $this->snippets()->pluck('id')->toArray());
    } 
    
    public function positions(){
      return Position::whereIn(
        'snippet_id', 
        $this->snippets()->pluck('id')->toArray())->get();
    }
  
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
  
    public function account()
    {
      if ($this->accounts()->count() == 0){
        return null;
      }
      if (!session()->has('account_id')){
        
          $id = $this->accounts()->first()->id;
         // session('account_id', $id);
          session(['account_id' => $id]);
        
      }
      $a = Account::find(session('account_id'));
      if (!$a){
        $id = $this->accounts()->first()->id;
        session(['account_id' => $id]);
      } 
      return Account::find(session('account_id'));
    }
  
    public function select($id)
    {
      // session('account_id', $id);
      session(['account_id' => $id]);
    }
  
    public function urls()
    {
        return $this->hasMany(Url::class);
    }
}
