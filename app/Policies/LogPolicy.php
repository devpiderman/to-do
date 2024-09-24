<?php

namespace App\Policies;

use App\Models\Log;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LogPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Log $log)
    {
        return $user->id === $log->user_id
            ? Response::allow()
            : Response::deny('You do not own this log.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Log $log)
    {
        return $user->id === $log->user_id
            ? Response::allow()
            : Response::deny('You do not own this log.');
    }
}
