<?php

namespace App\Services\Cms\Reservations\Repositories;

use App\Models\Apartment;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ReservationsRepository
{
    private const DEFAULT_TTL = 3600;

    public function getPaginate(User $user, int $itemsPerPage = null, int $linksLimit = null): LengthAwarePaginator
    {
        $itemsPerPage = $itemsPerPage ?? config('cms.pagination.items_per_page');
        $linksLimit = $linksLimit ?? config('cms.pagination.links_limit');
        $currentPage = request()->get('page', 1);

        $reservations = Cache::tags([Reservation::class, Apartment::class, Hotel::class])->remember(
            'reservations:organization=' . $user->organization_id . ':items_per_page=' . $itemsPerPage . 'current_page=' . $currentPage,
            config('cms.cache.lifetime', self::DEFAULT_TTL),
            function() use ($user, $itemsPerPage, $linksLimit) {
                return Reservation::with(['apartment.hotel.organization', 'user', 'status'])
                    ->whereHas('apartment.hotel.organization', function ($query) use ($user) {
                        return $query->where('id', $user->organization_id);
                    })
                    ->orderByDesc('created_at')
                    ->limit($itemsPerPage)
                    ->paginate($itemsPerPage)
                    ->onEachSide($linksLimit)
                    ->withQueryString();
            });

        return $reservations;
    }
}
