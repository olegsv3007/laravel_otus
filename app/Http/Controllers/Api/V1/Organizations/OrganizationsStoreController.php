<?php

namespace App\Http\Controllers\Api\V1\Organizations;

use App\Http\Controllers\Api\V1\Organizations\Requests\StoreOrganizationRequest;
use Illuminate\Http\JsonResponse;

class OrganizationsStoreController extends OrganizationsBaseController
{
    public function __invoke(StoreOrganizationRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        return
            $this->getOrganizationsService()->store($validatedData) ?
                response()->json('ok', JsonResponse::HTTP_CREATED) :
                response()->json('fail', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
