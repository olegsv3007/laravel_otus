@extends('layouts.app')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="apartment_container col-8">
            <h2>{{ $apartment->title }}</h2>
            <div class="limited_offer_item">
                <div class="limited_offer_image">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($apartment->images as $image)
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($apartment->images as $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img
                                        src="{{ $image->imageSrc }}"
                                        class="d-block w-100" alt="..."
                                    >
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="limited_offer_info">
                    <div class="limited_offer_price">$ {{ $apartment->price }}</div>
                    <div class="limited_offer_location"><x-icons.location></x-icons.location>{{ $apartment->hotel->city->name }}</div>
                    <div class="limited_offer_name">{{ $apartment->hotel->name }}</div>
                    <div class="limited_offer_description">{{ $apartment->description }}</div>
                    <div class="limited_offer_footer">
                        <div class="limited_offer_mark_container">
                            <x-icons.star></x-icons.star>
                            <div class="limited_offer_mark">4.5</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <form
                action="{{ route(\App\Services\Routes\Providers\Public\PublicRoutes::PUBLIC_RESERVATIONS_STORE, ['locale' => $locale, 'apartment' => $apartment]) }}"
                method="POST"
            >
                @csrf
                <h2>{{ __('public/pages/apartment.form.title') }}</h2>

                <x-wrappers.forms.bs-text
                    type="date"
                    name="date_start"
                    :value="session(App\Services\Public\Apartments\SessionService::KEY_SEARCH_START_DATE) ?? ''"
                    :label="__('public/pages/apartment.form.labels.arriving_date')"
                ></x-wrappers.forms.bs-text>

                <x-wrappers.forms.bs-text
                    type="date"
                    name="date_end"
                    :value="session(App\Services\Public\Apartments\SessionService::KEY_SEARCH_END_DATE) ?? ''"
                    :label="__('public/pages/apartment.form.labels.departure_date')"
                ></x-wrappers.forms.bs-text>

                <x-wrappers.forms.hidden-input
                    name="price"
                    :value="5000"
                ></x-wrappers.forms.hidden-input>

                <div class="summary_price float-right"><span class="title">{{ __('public/pages/apartment.form.labels.summary_price') }}: </span>$ {{ '5000' }}</div>
                <div class="clearfix"></div>
                <button class="btn btn-primary mt-2 float-right" type="submit">
                    {{ __('public/pages/apartment.form.labels.book_button' )}}</button>
            </form>
        </div>
    </div>
</div>
@endsection
