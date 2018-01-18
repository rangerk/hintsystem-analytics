<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Translate extends Model
{

    protected $table = 'translate';
  
    protected $fillable = [ 'key', 'en', 'test' ];
  
    public function translate($value){
      $found = Translate::where('key', '=', $value)->first();
      if ($found){
        //return $found[Auth::user()->translate];
        // return $found->test;
        //return $found->en;
        $selected = Auth::user() ? Auth::user()->translate : 'en';
        //return $found[ Auth::user()->translate ];
        return $found[ $selected ];
      }
      return $value . ' translating...';
    }
}
