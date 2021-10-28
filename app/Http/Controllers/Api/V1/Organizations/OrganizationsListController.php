<?php

namespace App\Http\Controllers\Api\V1\Organizations;

use App\Http\Controllers\Api\V1\Organizations\Resources\OrganizationResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class OrganizationsListController extends OrganizationsBaseController
{
    public function __invoke(Request $request): Responsable
    {
        $organizations = $this->getOrganizationsService()->all();

        return OrganizationResource::collection($organizations);
    }
}
