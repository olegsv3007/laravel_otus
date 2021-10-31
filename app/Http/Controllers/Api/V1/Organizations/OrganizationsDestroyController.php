<?php

namespace App\Http\Controllers\Api\V1\Organizations;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrganizationsDestroyController extends OrganizationsBaseController
{
    public function __invoke(Request $request, int $id): JsonResponse
    {
        return
            $this->getOrganizationsService()->destroy($id) ?
                response()->json('ok', JsonResponse::HTTP_ACCEPTED):
                response()->json('fail', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
