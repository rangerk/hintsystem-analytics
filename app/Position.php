<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [ 'snippet_id', 'url', 'element_id', 'element_class',
                          'location', 'alignment', ];
}
