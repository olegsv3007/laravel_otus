<?php

namespace App\Services\Public\Apartments\Repositories;

use App\Models\Apartment;
use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ApartmentRepository
{
    public function search(array $filter, int $count = null, int $linksLimit = null): ?LengthAwarePaginator
    {
        $itemsPerPage = $count ?? config('cms.pagination.items_per_page');
        $linksLimit = $linksLimit ?? config('cms.pagination.links_limit');

        return Cache::tags([Reservation::class, Apartment::class, Hotel::class])
            ->remember(
                $this->generateCacheKey($filter),
                config('cache.lifetime'),
                function() use ($filter, $itemsPerPage, $linksLimit) {
                    return Apartment::with(['hotel.city'])
                        ->when(isset($filter['city']), function ($query) use ($filter) {
                            return $query->whereHas('hotel.city', function ($query) use ($filter) {
                                return $query->where('name', 'LIKE', '%' . $filter['city'] . '%');
                            });
                        })
                        ->when(isset($filter['date_start']) || isset($filter['date_end']), function ($query) use ($filter, $itemsPerPage, $linksLimit) {
                            return $query
                                ->when(($filter['date_start'] && !$filter['date_end']), function ($query) use ($filter) {
                                    return $query->whereDoesntHave('reservations', function ($query) use ($filter) {
                                        return $query
                                            ->whereDate('date_start', '<=', $filter['date_start'])
                                            ->whereDate('date_end', '>=', $filter['date_start']);
                                    });
                                })
                                ->when(!$filter['date_start'] && $filter['date_end'], function ($query) use ($filter) {
                                    return $query->whereDoesntHave('reservations', function ($query) use ($filter) {
                                        return $query
                                            ->whereDate('date_start', '<=', $filter['date_end'])
                                            ->whereDate('date_end', '>=', $filter['date_end']);
                                    });
                                })
                                ->when($filter['date_start'] && $filter['date_end'], function ($query) use ($filter) {
                                    return $query->whereDoesntHave('reservations', function ($query) use ($filter) {
                                        return $query
                                            ->where(function ($query) use ($filter) {
                                                return $query->where(function ($query) use ($filter) {
                                                    return $query->where('date_start', '>', $filter['date_start'])
                                                        ->where('date_start', '<', $filter['date_end']);
                                                })->orWhere(function ($query) use ($filter) {
                                                    return $query->where('date_end', '>', $filter['date_start'])
                                                        ->where('date_end', '<', $filter['date_end']);
                                                })->orWhere(function ($query) use ($filter) {
                                                    return $query->where('date_start', '<', $filter['date_start'])
                                                        ->where('date_end', '>', $filter['date_end']);
                                                });
                                            });
                                    });
                                });
                        })
                        ->when(isset($filter['number_of_people']), function ($query) use ($filter) {
                            return $query->where('number_of_people', '>=', $filter['number_of_people']);
                        })
                        ->paginate($itemsPerPage)
                        ->onEachSide($linksLimit)
                        ->withQueryString();
                }
            );
    }

    private function generateCacheKey(array $filters): string
    {
        return 'apartments:paginate:' . http_build_query($filters, '', ':');
    }
}
