<?php

namespace App\Policies;

use App\User;
use App\Snippet;
use Illuminate\Auth\Access\HandlesAuthorization;

class SnippetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    public function destroy(User $user, Snippet $snippet)
    {
        return $user->id === $snippet->user_id;
    }
}
