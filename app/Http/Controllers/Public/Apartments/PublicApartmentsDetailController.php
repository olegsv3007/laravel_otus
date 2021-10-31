<?php

namespace App\Http\Controllers\Public\Apartments;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class PublicApartmentsDetailController extends BaseApartmentsController
{

    public function __invoke(Request $request, Apartment $apartment)
    {
        if (!$apartment) {
            return abort(404);
        }

        return view('public.apartments.detail', compact('apartment'));
    }
}
