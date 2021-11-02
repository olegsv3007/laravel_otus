<?php

namespace App\Http\Controllers\Api\V1\Reservations;

use App\Http\Controllers\Controller;
use App\Services\Api\Reservations\Repositories\ReservationsRepository;
use App\Services\Api\Reservations\ReservationsService;
use Illuminate\Http\Request;

class ReservationsBaseController extends Controller
{
    public function getReservationsService(): ReservationsService
    {
        return app(ReservationsService::class);
    }
}
