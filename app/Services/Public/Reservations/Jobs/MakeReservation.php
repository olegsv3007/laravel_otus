<?php

namespace App\Services\Public\Reservations\Jobs;

use App\Models\Apartment;
use App\Models\User;
use App\Services\Public\Reservations\Repositories\ReservationsRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MakeReservation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private array $orderData,
        private User $user,
        private Apartment $apartment,
    )
    { }

    public function handle()
    {
        $this->getReservationsRepository()->store($this->orderData, $this->user, $this->apartment);
    }

    public function getReservationsRepository(): ReservationsRepository
    {
        return app(ReservationsRepository::class);
    }
}
