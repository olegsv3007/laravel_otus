@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-3 filters_section">
                <form method="get" action="{{ route(\App\Services\Routes\Providers\Public\PublicRoutes::PUBLIC_APARTMENTS_INDEX, ['locale' => $locale]) }}">
                    <h3>{{ __('public/pages/search.headers.filters') }}</h3>
                    <x-wrappers.forms.bs-text
                        type="text"
                        name="city"
                        :value="$parameters['city'] ?? ''"
                        :label="__('public/pages/search.form.labels.city')"
                    />
                    <x-wrappers.forms.bs-text
                        type="date"
                        name="date_start"
                        :value="$parameters['date_start'] ?? ''"
                        :label="__('public/pages/search.form.labels.date_start')"
                    />
                    <x-wrappers.forms.bs-text
                        type="date"
                        name="date_end"
                        :value="$parameters['date_end'] ?? ''"
                        :label="__('public/pages/search.form.labels.date_end')"
                    />
                    <x-wrappers.forms.bs-text
                        type="number"
                        name="number_of_people"
                        :value="$parameters['number_of_people'] ?? ''"
                        :label="__('public/pages/search.form.labels.number_of_people')"
                    />
                    <button class="btn btn-primary" type="submit">Apply</button>
                </form>
            </div>
            <div class="col-9 apartments">
                <h3>{{ __('public/pages/search.headers.results') }}</h3>
                <div class="apartments-container">
                    @foreach($apartments as $apartment)
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $apartment->mainImageSrc }}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $apartment->title }}</h5>
                                        <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/search.apartment_card.city') }}:</span><span class="ml-2">{{ $apartment->hotel->city->name }}</span></p>
                                        <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/search.apartment_card.number_of_people') }}:</span><span class="ml-2">{{ $apartment->number_of_people }}</span></p>
                                        <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/search.apartment_card.price') }}:</span><span class="ml-2">$ {{ $apartment->price }}</span></p>
                                        <div class="row justify-content-end align-items-end m-1 mt-4">
                                            <a type="button" class="btn btn-primary" href="{{ route(\App\Services\Routes\Providers\Public\PublicRoutes::PUBLIC_APARTMENTS_DETAIL, ['locale' => $locale, 'apartment' => $apartment]) }}">{{ __('public/pages/search.apartment_card.detail') }}</a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row justify-content-center">
                        {{ $apartments->links('components.paginator.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
