<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\Routes\Providers\Api\ApiRoutesProvider;

$apiRoutesProvider = new ApiRoutesProvider();
$apiRoutesProvider->registerRoutes();


