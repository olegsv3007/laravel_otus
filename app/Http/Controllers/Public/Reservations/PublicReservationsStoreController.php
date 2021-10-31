<?php

namespace App\Http\Controllers\Public\Reservations;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Public\Reservations\BasePublicReservationsController;
use App\Http\Controllers\Public\Reservations\Requests\StoreReservationRequest;
use App\Models\Apartment;
use App\Services\Public\Reservations\Jobs\MakeReservation;
use App\Services\Routes\Providers\Public\PublicRoutes;

class PublicReservationsStoreController extends BasePublicReservationsController
{
    public function __invoke(StoreReservationRequest $request, Apartment $apartment)
    {
        $orderData = $request->validated();

        $this->getReservationService()
            ->store($orderData, $request->user(), $apartment);

        return redirect()->route(PublicRoutes::PUBLIC_RESERVATIONS_RESULT, ['locale' => $this->getLocale(), 'apartment' => $apartment ]);
    }
}
