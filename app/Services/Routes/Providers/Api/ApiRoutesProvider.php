<?php

namespace App\Services\Routes\Providers\Api;

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
        Route::middleware('api')
            ->get('/organizations', OrganizationsListController::class);

        Route::middleware('api')
            ->get('/organizations/{id}', OrganizationsShowController::class);

        Route::group(['middleware' => ['auth:api', 'auth.admin']], function() {
            Route::post('/organizations/', OrganizationsStoreController::class);

            Route::put('/organizations/{id}', OrganizationsUpdateController::class);

            Route::delete('/organizations/{id}', OrganizationsDestroyController::class);
        });
    }
}
