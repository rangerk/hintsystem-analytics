<?php

namespace App;

use App\Snippet;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $fillable = ['header', 'footer'];
  
    public function snippet()
    {
        return $this->belongsTo(Snippet::class);
    }
}
