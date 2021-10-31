<?php

namespace App\Observers;

use App\Models\Apartment;
use App\Models\Country;
use Illuminate\Support\Facades\Cache;

class ApartmentObserver
{
    public function created(Apartment $apartment)
    {
        $this->flushApartmentCache();
    }

    public function updated(Apartment $apartment)
    {
        $this->flushApartmentCache();
    }

    public function deleted(Apartment $apartment)
    {
        $this->flushApartmentCache();
    }

    public function restored(Apartment $apartment)
    {
        $this->flushApartmentCache();
    }

    public function forceDeleted(Apartment $apartment)
    {
        $this->flushApartmentCache();
    }

    private function flushApartmentCache()
    {
        Cache::tags(Apartment::class)->flush();
    }
}
