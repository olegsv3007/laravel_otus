<?php

namespace App\Services\Routes\Providers\Cms;

use App\Http\Controllers\Cms\Apartments\CmsApartmentsRestoreController;
use App\Http\Controllers\Cms\Cities\CmsCitiesRestoreController;
use App\Http\Controllers\Cms\Hotels\CmsHotelsRestoreController;
use App\Http\Controllers\Cms\Images\CmsImagesRemoveController;
use App\Http\Controllers\Cms\Organizations\CmsOrganizationsRestoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cms\Countries\CmsCountriesController;
use App\Http\Controllers\Cms\Cities\CmsCitiesController;
use App\Http\Controllers\Cms\Organizations\CmsOrganizationsController;
use App\Http\Controllers\Cms\Hotels\CmsHotelsController;
use App\Http\Controllers\Cms\Apartments\CmsApartmentsController;
use App\Http\Controllers\Cms\Countries\CmsCountriesRestoreController;

class CmsRoutesProvider
{
    public function registerRoutes(): void
    {
        Route::group([
            'prefix' => '/cms',
            'as' => 'cms.',
            'middleware' => 'auth'
        ], function() {
            Route::resources([
                'countries' => CmsCountriesController::class,
                'cities' => CmsCitiesController::class,
                'organizations' => CmsOrganizationsController::class,
                'hotels' => CmsHotelsController::class,
                'apartments' => CmsApartmentsController::class,
            ], [
                'except' => [
                    'show'
                ],
                'parameters' => [
                    'apartments' => 'apartment_no_scope',
                    'hotels' => 'hotel_no_scope',
                    'countries' => 'country_no_scope',
                    'cities' => 'city_no_scope',
                    'organizations' => 'organization_no_scope',
                ],
            ]);
        });

        Route::group([
            'prefix' => '/cms',
            'middleware' => 'auth'
        ], function() {
            Route::delete('/images/{image}', CmsImagesRemoveController::class)
                ->name(CmsRoutes::CMS_IMAGES_DELETE);

            Route::patch('/countries/{country_no_scope}/restore', CmsCountriesRestoreController::class)
                ->name(CmsRoutes::CMS_COUNTRIES_RESTORE);
            Route::patch('/cities/{city_no_scope}/restore', CmsCitiesRestoreController::class)
                ->name(CmsRoutes::CMS_CITIES_RESTORE);
            Route::patch('/organizations/{organization_no_scope}/restore', CmsOrganizationsRestoreController::class)
                ->name(CmsRoutes::CMS_ORGANIZATIONS_RESTORE);
            Route::patch('/hotels/{hotel_no_scope}/restore', CmsHotelsRestoreController::class)
                ->name(CmsRoutes::CMS_HOTELS_RESTORE);
            Route::patch('/apartments/{apartment_no_scope}/restore', CmsApartmentsRestoreController::class)
                ->name(CmsRoutes::CMS_APARTMENTS_RESTORE);
        });
    }
}
