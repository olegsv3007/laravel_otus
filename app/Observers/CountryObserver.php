<?php

namespace App\Observers;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;

class CountryObserver
{

    public function created(Country $country)
    {
        $this->flushCountryCache();
    }

    public function updated(Country $country)
    {
        $this->flushCountryCache();
    }

    public function deleted(Country $country)
    {
        $this->flushCountryCache();
    }

    public function restored(Country $country)
    {
        $this->flushCountryCache();
    }

    public function forceDeleted(Country $country)
    {
        $this->flushCountryCache();
    }

    private function flushCountryCache()
    {
        Cache::tags(Country::class)->flush();
    }
}
