<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FolderPolicy
{
    /**
     * Determine whether the user can view the folder.
     */
    public function view(User $user, Folder $folder)
    {
        // The user can view the folder if they own it
        return $user->id === $folder->user_id
            ? Response::allow()
            : Response::deny('You do not own this folder.');
    }

    /**
     * Determine whether the user can update the folder.
     */
    public function update(User $user, Folder $folder)
    {
        // The user can update the folder if they own it
        return $user->id === $folder->user_id
            ? Response::allow()
            : Response::deny('You do not own this folder.');
    }

    /**
     * Determine whether the user can delete the folder.
     */
    public function delete(User $user, Folder $folder)
    {
        // The user can delete the folder if they own it
        return $user->id === $folder->user_id
            ? Response::allow()
            : Response::deny('You do not own this folder.');
    }
}
