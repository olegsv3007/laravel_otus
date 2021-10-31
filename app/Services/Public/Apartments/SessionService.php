<?php

namespace App\Services\Public\Apartments;

use Illuminate\Support\Facades\Session;

class SessionService
{
    public const KEY_SEARCH_START_DATE = 'search_start_date';
    public const KEY_SEARCH_END_DATE = 'search_end_date';

    public function storeSearchParameters(array $parameters):void
    {
        if (isset($parameters['date_start'])) {
            Session::put(static::KEY_SEARCH_START_DATE, $parameters['date_start']);
        }

        if (isset($parameters['date_end'])) {
            Session::put(static::KEY_SEARCH_END_DATE, $parameters['date_end']);
        }
    }

    public function getSearchStartDate(): ?string
    {
        return Session::get(static::KEY_SEARCH_START_DATE, null);
    }

    public function getSearchEndDate(): ?string
    {
        return Session::get(static::KEY_SEARCH_END_DATE, null);
    }

}
