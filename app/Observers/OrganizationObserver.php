<?php

namespace App\Observers;

use App\Models\City;
use App\Models\Organization;
use Illuminate\Support\Facades\Cache;

class OrganizationObserver
{
    public function created(Organization $organization)
    {
        $this->flushOrganizationsCache();
    }

    public function updated(Organization $organization)
    {
        $this->flushOrganizationsCache();
    }

    public function deleted(Organization $organization)
    {
        $this->flushOrganizationsCache();
    }

    public function restored(Organization $organization)
    {
        $this->flushOrganizationsCache();
    }

    public function forceDeleted(Organization $organization)
    {
        $this->flushOrganizationsCache();
    }

    private function flushOrganizationsCache()
    {
        Cache::tags(Organization::class)->flush();
    }
}
