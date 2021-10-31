<?php

namespace App\Observers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Cache;

class CityObserver
{
    public function created(City $city)
    {
        $this->flushCityCache();
    }

    public function updated(City $city)
    {
        $this->flushCityCache();
    }

    public function deleted(City $city)
    {
        $this->flushCityCache();
    }

    public function restored(City $city)
    {
        $this->flushCityCache();
    }

    public function forceDeleted(City $city)
    {
        $this->flushCityCache();
    }

    private function flushCityCache()
    {
        Cache::tags(City::class)->flush();
    }
}
