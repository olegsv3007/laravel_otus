<?php

namespace App\Http\Controllers\Api\V1\Apartments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentsListController extends ApartmentsBaseController
{

    public function __invoke(Request $request)
    {
        $filters = $request->all();

        $apartments = $this->getApartmentsRepository()->search($filters);

        return response()->json($apartments);
    }
}
