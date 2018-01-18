<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;
use App\User;

class Invite extends Model
{
    protected $fillable = [ 'email', 'nickname', 'status', 'token', 
                          'user_id', 'account_id', 'role', ];
  
    protected $appends = [ 'owner', 'author', ];
    
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
  
    public function getOwnerAttribute()
    {
        return $this->account->nickname;
    } 
  
    public function getAuthorAttribute()
    {
       // return $this->account->user->name;
        return User::find($this->account->user_id)->name;
    } 
  
}
