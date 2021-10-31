<?php

namespace App\Services\Api\Organizations\Repositories;

use App\Models\Organization;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ApiOrganizationsRepository
{
    public int $cacheLifetime;

    public function __construct()
    {
        $this->cacheLifetime = config('cms.cache.life_time', 3600);
    }

    public function all(): Collection
    {
        return Cache::tags(Organization::class)
            ->remember(
                'organizations:all',
                $this->cacheLifetime,
                fn() => Organization::all()
            );
    }

    public function get(int $id): ?Organization
    {
        return Cache::tags(Organization::class)
            ->remember(
                'organizations:' . $id,
                $this->cacheLifetime,
                fn() => Organization::findOrFail($id)
            );
    }

    public function store(array $organizationArray): bool
    {
        $organization = Organization::create($organizationArray);

        return (bool)$organization;
    }

    public function update(int $id, array $organizationArray): bool
    {
        $organization = Organization::findOrFail($id);

        return (bool)$organization->update($organizationArray);
    }

    public function destroy(int $id): bool
    {
        return Organization::findOrFail($id)->delete();
    }
}
