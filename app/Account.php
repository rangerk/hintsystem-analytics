<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Snippet;
use App\User;
use App\Invite;

class Account extends Model
{
    //$fillable = [ 'user_id', 'user2_id', ];
  protected $fillable = [ 'user_id', 'nickname', 'domains',
              'counter','test','icons','translate','tab',
              'voting','columns','max','onoff',
            ];
  
  public function snippets()
  {
      return $this->hasMany(Snippet::class);
  }
  
  public function user()
  {
      return $this->belongsTo(User::class);
  }
  
  public function invites()
  {
      return $this->hasMany(Invite::class);
  }
}
