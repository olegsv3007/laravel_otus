<?php

namespace App\Http\Controllers\Cms\Reservations;

use App\Http\Controllers\Cms\Organizations\Requests\StoreOrganizationRequest;
use App\Models\Organization;
use App\Services\Routes\Providers\Cms\CmsRoutes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CmsReservationsController extends BaseCmsReservationsController
{
    public function index(Request $request): View
    {
        $reservations = $this->getReservationsService()->getPaginate($request->user());

        return view('cms.reservations.index', compact(['reservations']));
    }

}
