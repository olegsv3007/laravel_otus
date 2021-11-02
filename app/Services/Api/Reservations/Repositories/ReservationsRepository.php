<?php

namespace App\Services\Api\Reservations\Repositories;

use App\Models\Reservation;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ReservationsRepository
{
    public function findByUser(User $user): ?Collection
    {
        return Cache::tags([Reservation::class, User::class, Status::class])
            ->remember(
                'reservations:user:' . $user->id,
                config('cms.cache.life_time', 3600),
                fn () => $user->reservations
            );
    }

    public function findById(int $reservationId): ?Reservation
    {
        return Cache::tags([Reservation::class, Status::class])
            ->remember(
                'reservation:' . $reservationId,
                config('cms.cache.life_time', 3600),
                fn () => Reservation::findOrFail($reservationId)
            );
    }
}
