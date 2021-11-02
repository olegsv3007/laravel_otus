<?php

namespace App\Services\Api\Reservations;

use App\Models\Reservation;
use App\Models\User;
use App\Services\Api\Apartments\ApartmentsService;
use App\Services\Api\Reservations\Handlers\CalculatePriceHandler;
use App\Services\Api\Reservations\Repositories\ReservationsRepository;
use App\Services\Public\Reservations\Jobs\MakeReservation;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ReservationsService
{
    public function __construct(
        private ReservationsRepository $reservationsRepository,
        private CalculatePriceHandler $calculatePriceHandler,
        private ApartmentsService $apartmentsService,
    ) { }

    public function findByUser(User $user): ?Collection
    {
       return $this->reservationsRepository->findByUser($user);
    }

    public function findById(int $reservationId): ?Reservation
    {
        return $this->reservationsRepository->findById($reservationId);
    }

    public function store(array $reservationData, User $user)
    {
        $apartment = $this->apartmentsService->find($reservationData['apartment_id']);

        $reservationData['price'] = $this->calculatePriceHandler->handle(
            new Carbon($reservationData['date_start']),
            new Carbon($reservationData['date_end']),
            $apartment
        );

        MakeReservation::dispatch($reservationData, $user, $apartment);
    }
}
