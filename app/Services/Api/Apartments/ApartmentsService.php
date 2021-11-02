<?php

namespace App\Services\Api\Apartments;

use App\Models\Apartment;
use App\Services\Api\Apartments\Repositories\ApartmentsRepository;
use Illuminate\Support\Collection;

class ApartmentsService
{
    public function __construct(
        private ApartmentsRepository $apartmentsRepository,
    ) { }

    public function search(array $filters): ?Collection
    {
        return $this->apartmentsRepository->search($filters);
    }

    public function find(int $id): ?Apartment
    {
        return $this->apartmentsRepository->find($id);
    }
}
