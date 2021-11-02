<?php

namespace App\Providers;

use App\Models\Apartment;
use App\Models\Hotel;
use App\Models\Organization;
use App\Models\Reservation;
use App\Models\User;
use App\Policies\ApartmentPolicy;
use App\Policies\HotelPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\ReservationPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Organization::class => OrganizationPolicy::class,
        Hotel::class => HotelPolicy::class,
        Apartment::class => ApartmentPolicy::class,
        Reservation::class => ReservationPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        if (! $this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
