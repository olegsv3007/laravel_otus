<?php

namespace App\Services\Public\Reservations;

use App\Models\Apartment;
use App\Models\User;
use App\Services\Public\Reservations\Jobs\MakeReservation;
use App\Services\Public\Reservations\Repositories\ReservationsRepository;
use Carbon\Carbon;

class ReservationsService
{
    public function __construct(private ReservationsRepository $reservationsRepository)
    { }

    public function store(array $orderData, User $user, Apartment $apartment): void
    {
        $totalDays = Carbon::createFromDate($orderData['date_end'])->diffInDays(Carbon::createFromDate($orderData['date_start']));
        $totalPrice = $apartment->price * $totalDays;

        $orderData['price'] = $totalPrice;

        MakeReservation::dispatch($orderData, $user, $apartment);
    }

    public function getReservationsByUser(User $user, int $page)
    {
        return $this->reservationsRepository->getReservationsForUser($user, $page);
    }
}
