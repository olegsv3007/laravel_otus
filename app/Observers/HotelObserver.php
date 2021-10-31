<?php

namespace App\Observers;

use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Support\Facades\Cache;

class HotelObserver
{
    public function created(Hotel $hotel)
    {
        $this->flushHotelCache();
    }

    public function updated(Hotel $hotel)
    {
        $this->flushHotelCache();
    }

    public function deleted(Hotel $hotel)
    {
        $this->flushHotelCache();
    }

    public function restored(Hotel $hotel)
    {
        $this->flushHotelCache();
    }

    public function forceDeleted(Hotel $hotel)
    {
        $this->flushHotelCache();
    }

    private function flushHotelCache()
    {
        Cache::tags(Hotel::class)->flush();
    }
}
