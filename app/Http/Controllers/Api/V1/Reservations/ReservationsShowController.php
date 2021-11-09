<?php

namespace App\Http\Controllers\Api\V1\Reservations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReservationsShowController extends ReservationsBaseController
{

    public function __invoke(Request $request, int $reservationId)
    {
        $reservation = $this->getReservationsService()->findById($reservationId);

        Gate::authorize('view', $reservation);

        return response()->json($reservation);
    }
}
