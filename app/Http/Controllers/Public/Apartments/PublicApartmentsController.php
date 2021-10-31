<?php

namespace App\Http\Controllers\Public\Apartments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicApartmentsController extends BaseApartmentsController
{
    public function __invoke(Request $request): View
    {
        $filters = $request->all();

        $apartments = $this->getApartmentsService()->search($filters);
        $this->getSessionService()->storeSearchParameters($filters);

        return view('public.apartments.index', compact('apartments'));
    }
}
