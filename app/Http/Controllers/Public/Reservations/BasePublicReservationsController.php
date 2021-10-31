<?php

namespace App\Http\Controllers\Public\Reservations;

use App\Http\Controllers\Controller;
use App\Services\Public\Reservations\ReservationsService;

class BasePublicReservationsController extends Controller
{
    public function getReservationService(): ReservationsService
    {
        return app(ReservationsService::class);
    }
}
