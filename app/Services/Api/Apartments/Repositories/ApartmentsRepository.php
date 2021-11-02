<?php

namespace App\Services\Api\Apartments\Repositories;

use App\Models\Apartment;
use App\Models\Hotel;
use App\Models\Reservation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ApartmentsRepository
{
    public function search(array $filters): ?Collection
    {
        return Cache::tags([Reservation::class, Apartment::class, Hotel::class])
            ->remember(
                $this->generateCacheKey($filters),
                config('cache.lifetime'),
                function() use ($filters) {
                    return Apartment::with(['hotel.city'])
                        ->when(isset($filters['city']), function ($query) use ($filters) {
                            return $query->whereHas('hotel.city', function ($query) use ($filters) {
                                return $query->where('name', 'LIKE', '%' . $filters['city'] . '%');
                            });
                        })
                        ->when(isset($filters['date_start']) || isset($filters['date_end']), function ($query) use ($filters) {
                            return $query
                                ->when((isset($filters['date_start']) && !isset($filters['date_end'])), function ($query) use ($filters) {
                                    return $query->whereDoesntHave('reservations', function ($query) use ($filters) {
                                        return $query
                                            ->whereDate('date_start', '<=', $filters['date_start'])
                                            ->whereDate('date_end', '>=', $filters['date_start']);
                                    });
                                })

                                ->when(!isset($filters['date_start']) && isset($filters['date_end']), function ($query) use ($filters) {
                                    return $query->whereDoesntHave('reservations', function ($query) use ($filters) {
                                        return $query
                                            ->whereDate('date_start', '<=', $filters['date_end'])
                                            ->whereDate('date_end', '>=', $filters['date_end']);
                                    });
                                })

                                ->when(isset($filters['date_start']) && isset($filters['date_end']), function ($query) use ($filters) {
                                    return $query->whereDoesntHave('reservations', function ($query) use ($filters) {
                                        return $query
                                            ->where(function ($query) use ($filters) {
                                                return $query->where(function ($query) use ($filters) {
                                                    return $query->where('date_start', '>', $filters['date_start'])
                                                        ->where('date_start', '<', $filters['date_end']);
                                                })->orWhere(function ($query) use ($filters) {
                                                    return $query->where('date_end', '>', $filters['date_start'])
                                                        ->where('date_end', '<', $filters['date_end']);
                                                })->orWhere(function ($query) use ($filters) {
                                                    return $query->where('date_start', '<', $filters['date_start'])
                                                        ->where('date_end', '>', $filters['date_end']);
                                                });
                                            });
                                    });
                                });
                        })
                        ->when(isset($filters['number_of_people']), function ($query) use ($filters) {
                            return $query->where('number_of_people', '>=', $filters['number_of_people']);
                        })
                        ->get();
                }
            );
    }

    public function find(int $id): ?Apartment
    {
        return Apartment::findOrFail($id);
    }

    private function generateCacheKey(array $filters): string
    {
        return 'apartments:' . http_build_query($filters, '', ':');
    }
}
