<?php

namespace App\Http\Controllers\Api\V1\Apartments;

use App\Http\Controllers\Controller;
use App\Services\Api\Apartments\Repositories\ApartmentsRepository;
use Illuminate\Http\Request;

class ApartmentsBaseController extends Controller
{
    public function getApartmentsRepository(): ApartmentsRepository
    {
        return app(ApartmentsRepository::class);
    }
}
