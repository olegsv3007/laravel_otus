<?php

namespace App\Http\Controllers\Api\V1\Organizations;

use App\Http\Controllers\Controller;
use App\Services\Api\Organizations\Repositories\ApiOrganizationsRepository;

class OrganizationsBaseController extends Controller
{
    public function getOrganizationsService()
    {
        return app(ApiOrganizationsRepository::class);
    }
}
