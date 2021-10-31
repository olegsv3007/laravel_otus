@extends('layouts.profile')

@section('title', __('public/pages/order_history.title'))
@section('content')

    <x-order-history.block :reservations="$reservations"/>
@endsection
