<?php

namespace App\Http\Controllers\Public\Reservations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicReservationsIndexController extends BasePublicReservationsController
{

    public function __invoke(Request $request)
    {
        $reservations = $this->getReservationService()->getReservationsByUser($request->user(), $request->get('page', 1));

        return view('public.order_history', compact('reservations'));
    }
}
