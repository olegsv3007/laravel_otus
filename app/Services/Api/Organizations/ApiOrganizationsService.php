<?php

namespace App\Services\Api\Organizations;

use App\Models\Organization;
use App\Services\Api\Organizations\Repositories\ApiOrganizationsRepository;
use Illuminate\Support\Collection;

class ApiOrganizationsService
{
    public function __construct(private ApiOrganizationsRepository $organizationsRepository)
    { }

    public function all(): Collection
    {
        return $this->organizationsRepository->all();
    }

    public function get(int $id): ?Organization
    {
        return $this->organizationsRepository->get($id);
    }

    public function store(array $organizationArr): bool
    {
        return $this->organizationsRepository->store($organizationArr);
    }

    public function update(int $id, array $organizationArr): bool
    {
        return $this->organizationsRepository->update($id, $organizationArr);
    }

    public function destroy(int $id): bool
    {
        return $this->organizationsRepository->destory($id);
    }
}
