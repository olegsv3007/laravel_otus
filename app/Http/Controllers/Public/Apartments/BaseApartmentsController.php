<?php

namespace App\Http\Controllers\Public\Apartments;

use App\Http\Controllers\Controller;
use App\Services\Public\Apartments\ApartmentService;
use App\Services\Public\Apartments\SessionService;
use Illuminate\Http\Request;

class BaseApartmentsController extends Controller
{
    protected function getApartmentsService()
    {
        return app(ApartmentService::class);
    }

    protected function getSessionService()
    {
        return app(SessionService::class);
    }
}
