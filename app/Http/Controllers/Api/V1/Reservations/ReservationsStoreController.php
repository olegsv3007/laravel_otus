<?php

namespace App\Http\Controllers\Api\V1\Reservations;

use App\Http\Controllers\Api\V1\Reservations\Requests\ReservationStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReservationsStoreController extends ReservationsBaseController
{
    public function __invoke(ReservationStoreRequest $request)
    {
        $validatedData = $request->validated();
        $user = $request->user();

        $this->getReservationsService()->store($validatedData, $user);

        return response()->json('ok');
    }
}
