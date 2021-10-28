<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Organization;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Models\Apartment;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api/v1')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        Route::bind('apartment_no_scope', function ($id) {
            return Apartment::withoutGlobalScopes()->findOrFail($id);
        });

        Route::bind('hotel_no_scope', function ($slug) {
            return Hotel::withoutGlobalScopes()->where('slug', $slug)->first();
        });

        Route::bind('country_no_scope', function ($id) {
            return Country::withoutGlobalScopes()->findOrFail($id);
        });

        Route::bind('city_no_scope', function ($id) {
            return City::withoutGlobalScopes()->findOrFail($id);
        });

        Route::bind('organization_no_scope', function ($id) {
            return Organization::withoutGlobalScopes()->findOrFail($id);
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
