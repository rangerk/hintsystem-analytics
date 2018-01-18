<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Style;
use App\Vote;
use App\Account;

class Snippet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'snippet', 'nickname', 'num', 'on', 'tags', 
                           'header', 'footer', 'activation', 'icon', 'type', 
                           'icons', 'voting', 'account_id', ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
    ];

    protected $appends = [ 'author', 'votes' ];
   // protected $attributes = [ 'author' => '' ];
    protected $hidden = [ 'user' ];
  
    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
    public function styles()
    {
        return $this->hasMany(Style::class);
    }
  
    public function votes(){
      return $this->hasMany(Vote::class);
    }
  
    public function getAuthorAttribute(){
      //return 'Hello';
      //return $this->user->name;
      return $this->account->nickname;
    }
  
    public function getVotesAttribute(){
      //return 'Hello';
      return $this->votes()->where('value', 'helpful')->count() . ' | ' 
        . $this->votes()->where('value', 'not helpful')->count();
    }
  
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
