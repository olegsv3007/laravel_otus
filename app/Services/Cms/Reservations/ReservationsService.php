<?php

namespace App\Services\Cms\Reservations;

use App\Services\Cms\Reservations\Repositories\ReservationsRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\User;

class ReservationsService
{
    public function __construct(private ReservationsRepository $reservationsRepository)
    {

    }
    public function getPaginate(User $user): LengthAwarePaginator|Collection
    {
        return $this->reservationsRepository->getPaginate($user);
    }
}
