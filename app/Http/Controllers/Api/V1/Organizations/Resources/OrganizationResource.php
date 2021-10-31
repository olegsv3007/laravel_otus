<?php

namespace App\Http\Controllers\Api\V1\Organizations\Resources;

use App\Models\Organization;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    /**
     * @mixin Organization
     */
    public function toArray($request): array
    {
        return $this->only([
            'id',
            'name',
            'phone',
            'email',
        ]);
    }
}
