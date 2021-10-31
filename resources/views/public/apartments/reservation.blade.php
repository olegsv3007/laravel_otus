@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mt-5">{{ __('public/pages/reservation.success') }}</h2>
        </div>
        <div class="row justify-content-center">
            <h3 class="mt-2">
                <a href="{{ route(\App\Services\Routes\Providers\Public\PublicRoutes::HOME, ['locale' => $locale]) }}">{{ __('public/pages/reservation.back') }}</a>
            </h3>
        </div>
    </div>
@endsection
