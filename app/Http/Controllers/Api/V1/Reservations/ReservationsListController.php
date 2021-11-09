<?php

namespace App\Http\Controllers\Api\V1\Reservations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationsListController extends ReservationsBaseController
{
    public function __invoke(Request $request)
    {
        $reservations = $this->getReservationsService()->findByUser($request->user());

        return response()->json($reservations);
    }
}
