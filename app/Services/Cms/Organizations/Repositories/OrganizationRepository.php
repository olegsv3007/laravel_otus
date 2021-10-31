<?php

namespace App\Services\Cms\Organizations\Repositories;

use App\Models\Hotel;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class OrganizationRepository
{
    public function get(): Collection
    {
        return Cache::tags([Organization::class])->remember(
            'cms_all_organizations',
            config('cms.cache.lifetime'),
            function() {
                return Organization::withoutGlobalScopes()->get();
            }
        );
    }

    public function getPaginate(int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        $itemsPerPage = $count ?? config('cms.pagination.items_per_page');
        $linksLimit = $linksLimit ?? config('cms.pagination.links_limit');
        $currentPage = request()->get('page', 1);

        return Cache::tags([Organization::class])->remember(
            "cms_paginated_organizations:all:per_page:{$itemsPerPage}:links_limit:{$linksLimit}:currentPage:{$currentPage}",
            config('cms.cache.lifetime'),
            function() use ($itemsPerPage, $linksLimit) {
                return Organization::withTrashed()
                    ->paginate($itemsPerPage)
                    ->onEachSide($linksLimit);
                }
        );
    }

    public function store(array $data): ?Organization
    {
        $organization = Organization::create($data);

        if (!$organization) {
            return null;
        }

        return $organization;
    }

    public function update(array $data, Organization $organization): ?Organization
    {
        if (!$organization->update($data)) {
            return null;
        }

        return $organization;
    }

    public function delete(Organization $organization): bool
    {
        if (!$organization->delete()) {
            return false;
        }

        return true;
    }

    public function restore(Organization $organization): ?bool
    {
        return $organization->restore();
    }
}
