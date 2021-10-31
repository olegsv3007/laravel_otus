
@props(['reservations'])

<div class="container">
    @forelse($reservations as $reservation)
        <x-order-history.item :reservation="$reservation" />
    @empty
        <div>{{ __('public/pages/order_history.no_elements') }}</div>
    @endforelse
    <div class="row justify-content-center">
        {{ $reservations->links() }}
    </div>

</div>
