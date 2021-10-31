<?php

namespace App\Services\Cms\Apartments\Repositories;

use App\Models\Apartment;
use App\Models\Hotel;
use App\Models\Image;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ApartmentRepository
{
    public function get(): Collection
    {
        return Cache::tags([Apartment::class])->remember(
            'apartments:all',
            config('cms.cache.lifetime'),
            function() {
                return Apartment::withoutGlobalScopes()->get();
            }
        );
    }

    public function getPaginate(int $organizationId, int $count = null, int $linksLimit = null): LengthAwarePaginator
    {
        $itemsPerPage = $count ?? config('cms.pagination.items_per_page');
        $linksLimit = $linksLimit ?? config('cms.pagination.links_limit');
        $currentPage = request()->get('page', 1);

        return Cache::tags([Apartment::class, Hotel::class])->remember(
            "apartments:all:organization:$organizationId:per_page:{$itemsPerPage}:links_limit:{$linksLimit}:currentPage:{$currentPage}",
            config('cms.cache.lifetime'),
            function() use ($itemsPerPage, $linksLimit) {
                return Apartment::withoutGlobalScopes()
                    ->whereHas('hotel', function($query) {
                        return $query->where('organization_id', auth()->user()->organization_id);
                    })
                    ->with(['hotel' => function ($query) {
                        return $query->withTrashed();
                    }])
                    ->paginate($itemsPerPage)
                    ->onEachSide($linksLimit);
            }
        );
    }

    public function store(array $data, array $images): ?Apartment
    {
        $apartment = Apartment::create($data);

        if (!$apartment) {
            return null;
        }

        foreach ($images as $image) {
            $apartment->images()->create(['filename' => $image]);
        }

        return $apartment;
    }

    public function update(array $data, Apartment $apartment, array $images): ?Apartment
    {
        if (!$apartment->update($data)) {
            return null;
        }

        foreach ($images as $image) {
            $apartment->images()->create(['filename' => $image]);
        }

        return $apartment;
    }

    public function find($id): ?Apartment
    {
        return Apartment::withoutGlobalScope(ActiveScope::class)->findOrFail($id);
    }

    public function delete(Apartment $apartment): bool
    {
        if (!$apartment->delete()) {
            return false;
        }

        return true;
    }

    public function restore(Apartment $apartment): ?bool
    {
        return $apartment->restore();
    }
}
