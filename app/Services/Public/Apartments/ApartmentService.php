<?php

namespace App\Services\Public\Apartments;

use App\Services\Public\Apartments\Repositories\ApartmentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ApartmentService
{
    public function __construct(private ApartmentRepository $apartmentRepository)
    {

    }
    public function search(array $filters): ?LengthAwarePaginator
    {
        return $this->apartmentRepository->search($filters);
    }
}
