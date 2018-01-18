<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = [ 'token', 'user_id', 'account_id' ];
}
