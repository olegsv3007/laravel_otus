<?php

namespace App\Services\Routes\Providers\Api;

use App\Http\Controllers\Api\V1\Apartments\ApartmentsListController;
use App\Http\Controllers\Api\V1\Apartments\ApartmentsShowController;
use App\Http\Controllers\Api\V1\Reservations\ReservationsListController;
use App\Http\Controllers\Api\V1\Reservations\ReservationsShowController;
use App\Http\Controllers\Api\V1\Reservations\ReservationsStoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Organizations\OrganizationsListController;
use App\Http\Controllers\Api\V1\Organizations\OrganizationsShowController;
use App\Http\Controllers\Api\V1\Organizations\OrganizationsStoreController;
use App\Http\Controllers\Api\V1\Organizations\OrganizationsUpdateController;
use App\Http\Controllers\Api\V1\Organizations\OrganizationsDestroyController;

class ApiRoutesProvider
{
    public function registerRoutes()
    {
        Route::group(['middleware' => ['auth:api', 'auth.admin']], function() {
            Route::get('/organizations', OrganizationsListController::class);

            Route::get('/organizations/{id}', OrganizationsShowController::class);

            Route::post('/organizations/', OrganizationsStoreController::class);

            Route::put('/organizations/{id}', OrganizationsUpdateController::class);

            Route::delete('/organizations/{id}', OrganizationsDestroyController::class);
        });

        Route::group(['middleware' => ['auth:api']], function() {
            Route::get('/apartments', ApartmentsListController::class);
            Route::get('/apartments/{id}', ApartmentsShowController::class);

            Route::get('/reservations', ReservationsListController::class);
            Route::get('/reservations/{id}', ReservationsShowController::class);
            Route::post('/reservations', ReservationsStoreController::class);
        });
    }
}
