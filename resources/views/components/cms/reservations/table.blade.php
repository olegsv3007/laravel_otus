
@props(['reservations'])

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">{{ __('cms/reservations.titles.id') }}</th>
        <th scope="col">{{ __('cms/reservations.titles.status') }}</th>
        <th scope="col">{{ __('cms/reservations.titles.hotel') }}</th>
        <th scope="col">{{ __('cms/reservations.titles.apartment') }}</th>
        <th scope="col">{{ __('cms/reservations.titles.user') }}</th>
        <th scope="col">{{ __('cms/reservations.titles.date_start') }}</th>
        <th scope="col">{{ __('cms/reservations.titles.date_end') }}</th>
        <th scope="col">{{ __('cms/reservations.titles.created_at') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($reservations as $reservation)
        <x-cms.reservations.row :reservation="$reservation"></x-cms.reservations.row>
    @empty
        <x-cms.reservations.row-empty></x-cms.reservations.row-empty>
    @endforelse
    </tbody>
</table>
