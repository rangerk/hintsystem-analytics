<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Style;
use App\Vote;
use App\Account;

class Api extends Model
{
  
    protected $table = 'snippets';
  
    protected $fillable = ['content', 'snippet', 'nickname', 'num', 'on', 'tags', 
                           'header', 'footer', 'activation', 'icon', 'type', 
                           'icons', 'voting', 'account_id', ];
}
