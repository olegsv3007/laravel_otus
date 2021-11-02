<?php

namespace App\Services\Api\Reservations\Handlers;

use App\Models\Apartment;
use Carbon\Carbon;

class CalculatePriceHandler
{
    public function handle(Carbon $dateStart, Carbon $dateEnd, Apartment $apartment): float
    {
        return $dateEnd->diffInDays($dateStart) * $apartment->price;
    }
}
