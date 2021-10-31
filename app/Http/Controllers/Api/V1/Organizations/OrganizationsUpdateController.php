<?php

namespace App\Http\Controllers\Api\V1\Organizations;

use App\Http\Controllers\Api\V1\Organizations\Requests\StoreOrganizationRequest;
use Illuminate\Http\JsonResponse;

class OrganizationsUpdateController extends OrganizationsBaseController
{
    public function __invoke(StoreOrganizationRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        return
            $this->getOrganizationsService()->update($id, $validatedData) ?
                response()->json('ok', JsonResponse::HTTP_CREATED) :
                response()->json('fail', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
}
