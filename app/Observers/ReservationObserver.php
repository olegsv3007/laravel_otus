<?php

namespace App\Observers;

use App\Models\Reservation;
use App\Models\Status;
use App\Notifications\OrderCreated;
use App\Notifications\OrderDatesExpired;
use App\Notifications\OrderStatusChanged;
use Illuminate\Support\Facades\Cache;

class ReservationObserver
{
    public function created(Reservation $reservation)
    {
        $this->flushReservationsCache();

        if ($reservation->status->title == Status::STATUS_CANCEL) {
            $reservation->user->notify(new OrderDatesExpired($reservation));
        } else {
            $reservation->user->notify(new OrderCreated($reservation));
        }
    }

    public function updated(Reservation $reservation)
    {
        $this->flushReservationsCache();

        if ($reservation->getOriginal()['status_id'] != $reservation->getDirty()['status_id']) {
            $oldStatus = Status::findOrFail($reservation->getOriginal()['status_id']);
            $reservation->user->notify(new OrderStatusChanged($reservation, $oldStatus));
        }
    }

    public function deleted(Reservation $reservation)
    {
        $this->flushReservationsCache();
    }

    public function restored(Reservation $reservation)
    {
        $this->flushReservationsCache();
    }

    public function forceDeleted(Reservation $reservation)
    {
        $this->flushReservationsCache();
    }

    private function flushReservationsCache()
    {
        Cache::tags(Reservation::class)->flush();
    }
}
