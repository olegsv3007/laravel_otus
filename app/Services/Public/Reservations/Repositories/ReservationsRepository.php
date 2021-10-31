<?php

namespace App\Services\Public\Reservations\Repositories;

use App\Models\Apartment;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Status;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReservationsRepository
{
    public function store(array $orderData, User $user, Apartment $apartment): bool
    {
        $statusPendingId = Status::firstWhere('title', Status::STATUS_PENDING)->id;

        $reservation = Reservation::make([
            'user_id' => $user->id,
            'apartment_id' => $apartment->id,
            'date_start' => $orderData['date_start'],
            'date_end' => $orderData['date_end'],
            'price' => $orderData['price'],
            'status_id' => $statusPendingId,
        ]);

        if ($this->isApartmentFreeForPeriod($apartment, $orderData['date_start'], $orderData['date_end'])) {
            $statusWaitForPaymentId = Status::firstWhere('title', Status::STATUS_WAIT_FOR_PAYMENT)->id;
            $reservation->status_id = $statusWaitForPaymentId;
            $reservation->save();

            return true;
        }

        $statusCanceledId = Status::firstWhere('title', Status::STATUS_CANCEL)->id;
        $reservation->status_id = $statusCanceledId;
        $reservation->save();

        return false;
    }

    public function getReservationsForUser(User $user, int $page = 1): LengthAwarePaginator
    {
        $itemsPerPage = config('cms.pagination.items_per_page');
        $linksLimit = config('cms.pagination.links_limit');

        return Cache::tags([Reservation::class, Apartment::class, Hotel::class, City::class, Status::class])
            ->remember(
                'reservations:user-' . $user->id . ':page-' . $page . ':items_per_page-' . $itemsPerPage,
                config('life_time'),
                function() use ($user, $itemsPerPage, $linksLimit) {
                    return $user
                        ->reservations()
                        ->with(['apartment.hotel.city', 'status'])
                        ->orderByDesc('created_at')
                        ->paginate($itemsPerPage)
                        ->onEachSide($linksLimit);
                }
            );
    }

    private function isApartmentFreeForPeriod(Apartment $apartment, string $dateStart, string $dateEnd): bool
    {
        return Reservation::where('apartment_id', $apartment->id)
            ->where('status_id', '!=', Status::firstWhere('title', Status::STATUS_CANCEL)->id)
            ->where(function ($query) use ($dateStart, $dateEnd) {
                return $query->where(function ($query) use ($dateStart, $dateEnd) {
                    return $query->where('date_start', '>', $dateStart)
                        ->where('date_start', '<', $dateEnd);
                })->orWhere(function ($query) use ($dateStart, $dateEnd) {
                    return $query->where('date_end', '>', $dateStart)
                        ->where('date_end', '<', $dateEnd );
                })->orWhere(function ($query) use ($dateStart, $dateEnd) {
                    return $query->where('date_start', '<=', $dateStart)
                        ->where('date_end', '>=', $dateEnd);
                });
        })->count() === 0;
    }
}
