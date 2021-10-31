<?php

namespace App\Http\Controllers\Public\Reservations;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class PublicReservationsResultController extends Controller
{
    public function __invoke(Apartment $apartment)
    {
        return view('public.apartments.reservation', compact('apartment'));
    }
}
