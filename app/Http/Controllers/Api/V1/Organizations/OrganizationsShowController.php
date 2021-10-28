<?php

namespace App\Http\Controllers\Api\V1\Organizations;

use App\Http\Controllers\Api\V1\Organizations\Resources\OrganizationResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class OrganizationsShowController extends OrganizationsBaseController
{
    public function __invoke(Request $request, int $id): Responsable
    {
        $organization = $this->getOrganizationsService()->get($id);

        return new OrganizationResource($organization);
    }
}
