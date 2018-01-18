<?php

namespace App\Repositories;

use App\User;
use App\Snippet;

class SnippetRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Snippet::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
  
    public function generate($id){
      // return '<div class="hs" id="' . $id . '"></div>';
        $s = Snippet::find($id);
        return '<div class="_hintsystem" id="' . str_pad(/*$s->user_id*/$s->account_id, 5, '0', STR_PAD_LEFT) . '-' 
          . str_pad($s->num, 4, '0', STR_PAD_LEFT) . '"></div>';
    }
}
