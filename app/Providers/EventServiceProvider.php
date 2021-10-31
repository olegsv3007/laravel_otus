<?php

namespace App\Providers;

use App\Models\Apartment;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Organization;
use App\Models\Reservation;
use App\Observers\ApartmentObserver;
use App\Observers\CityObserver;
use App\Observers\CountryObserver;
use App\Observers\HotelObserver;
use App\Observers\OrganizationObserver;
use App\Observers\ReservationObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot()
    {
        Country::observe(CountryObserver::class);
        City::observe(CityObserver::class);
        Organization::observe(OrganizationObserver::class);
        Hotel::observe(HotelObserver::class);
        Apartment::observe(ApartmentObserver::class);
        Reservation::observe(ReservationObserver::class);
    }
}
