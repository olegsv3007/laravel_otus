<?php

namespace App\Http\Controllers\Api\V1\Apartments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentsShowController extends ApartmentsBaseController
{

    public function __invoke(Request $request, int $apartmentId)
    {
        $apartment = $this->getApartmentsRepository()->find($apartmentId);

        return response()->json($apartment);
    }
}
