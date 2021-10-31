@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-5">
        <h2>{{ __('cms/reservations.headers.index') }}</h2>
        <x-cms.reservations.table :reservations="$reservations" />
        <div class="d-flex justify-content-center">
            {{ $reservations->count() ? $reservations->links('components.paginator.default') : '' }}
        </div>
    </div>
@endsection
