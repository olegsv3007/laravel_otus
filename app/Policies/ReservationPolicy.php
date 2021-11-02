<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin;
    }

    public function view(User $user, Reservation $reservation)
    {
        return
            $user->id == $reservation->user_id ||
            $user->isManager && $user->organizationId == $reservation->apartment->hotel->organization_id ||
            $user->isAdmin;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Reservation $reservation)
    {
        return $user->id == $reservation->user_id ||
        $user->isManager && $user->organizationId == $reservation->apartment->hotel->organization_id ||
        $user->isAdmin;
    }
}
