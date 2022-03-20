<?php

namespace App\Policies;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Invitation $invitation)
    {
        return $invitation->user_id == $user->user_id;
    }
}
