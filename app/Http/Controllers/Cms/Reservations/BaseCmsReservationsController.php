<?php

namespace App\Http\Controllers\Cms\Reservations;

use App\Http\Controllers\Controller;
use App\Services\Cms\Reservations\ReservationsService;

class BaseCmsReservationsController extends Controller
{
    protected function getReservationsService(): ReservationsService
    {
        return app(ReservationsService::class);
    }
}
