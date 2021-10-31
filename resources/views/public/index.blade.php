@extends('layouts.app')

@section('content')
    <div class="search">
        <div class="search_form">
            <form method="get" action="{{ route(\App\Services\Routes\Providers\Public\PublicRoutes::PUBLIC_APARTMENTS_INDEX, ['locale' => $locale]) }}">
                <h2 class="slogan">{{ __('public/common.search_form.slogan') }}</h2>
                <input type="text" name="city" placeholder="{{ __('public/common.search_form.city') }}" />
                <div class="search_form_error">Текст ошибки валидации</div>
                <input placeholder="{{ __('public/common.search_form.date_start') }}" name="date_start" type="text" onfocus="(this.type='date')" id="date">
                <div class="search_form_error">Текст ошибки валидации</div>
                <input placeholder="{{ __('public/common.search_form.date_end') }}" name="date_end" type="text" onfocus="(this.type='date')" id="date">
                <div class="search_form_error">Текст ошибки валидации</div>
                <input type="number" name="number_of_people" placeholder="{{ __('public/common.search_form.quantity_people') }}" />
                <div class="search_form_error">Текст ошибки валидации</div>
                <button type="submit">{{ __('public/common.search_form.submit_button') }}</button>>
            </form>
        </div>
    </div>
    <x-limited-offer.block />
@endsection
