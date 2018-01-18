<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Snippet;

class Vote extends Model
{

   // protected $table = 'translate';
  
    protected $fillable = [ 'token', 'snippet_id', 'value' ];
  
  public function snippet(){
    return $this->belongsTo(Snippet::class);
  }
}
