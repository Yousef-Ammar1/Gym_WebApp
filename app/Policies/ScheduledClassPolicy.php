<?php

namespace App\Policies;

use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ScheduledClassPolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(User $user, ScheduledClass $scheduledClass)
    {
        return $user->id === $scheduledClass->instructor_id
            ? Response::allow()
            : Response::deny('You are not authorized to delete this class.');
        ;
    }
}
