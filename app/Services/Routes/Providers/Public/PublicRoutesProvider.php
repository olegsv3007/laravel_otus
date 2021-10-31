<?php

namespace App\Services\Routes\Providers\Public;


use App\Http\Controllers\Public\Apartments\PublicApartmentsController;
use App\Http\Controllers\Public\Apartments\PublicApartmentsDetailController;
use App\Http\Controllers\Public\Reservations\PublicReservationsIndexController;
use App\Http\Controllers\Public\Reservations\PublicReservationsResultController;
use App\Http\Controllers\Public\Reservations\PublicReservationsStoreController;
use Illuminate\Support\Facades\Route;

class PublicRoutesProvider
{
    public function registerRoutes()
    {
        Route::group([
            'prefix' => '/{locale}'
        ], function () {
            Route::get('/apartments', PublicApartmentsController::class)
                ->name(PublicRoutes::PUBLIC_APARTMENTS_INDEX);

            Route::get('/apartments/{apartment}', PublicApartmentsDetailController::class)
                ->name(PublicRoutes::PUBLIC_APARTMENTS_DETAIL);

            Route::group([
                'middleware' => 'auth',
            ], function() {
                Route::post('/apartments/{apartment}/order', PublicReservationsStoreController::class)
                    ->name(PublicRoutes::PUBLIC_RESERVATIONS_STORE);

                Route::get('/apartments/{apartment}/order/result', PublicReservationsResultController::class)
                    ->name(PublicRoutes::PUBLIC_RESERVATIONS_RESULT);

                Route::get('/order_history', PublicReservationsIndexController::class)
                ->name(PublicRoutes::PUBLIC_PROFILE_ORDER_HISTORY);
            });
        });
    }
}
