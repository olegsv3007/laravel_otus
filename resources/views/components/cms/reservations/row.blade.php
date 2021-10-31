
@props(['reservation'])

<tr class="clickable-row" data-href="">
    <th scope="row" class="col-1">{{ $reservation->id }}</th>
    <td class="col-2">
        <span class="badge text-white badge-{{ $reservation->status->bootstrapClass }}">
            {{ $reservation->status->title }}
        </span></td>
    <td class="col-2">{{ $reservation->apartment->hotel->name }}</td>
    <td class="col-3">{{ $reservation->apartment->title }}</td>
    <td class="col-2">{{ $reservation->user->email }}</td>
    <td class="col-1">{{ $reservation->date_start->format('Y-m-d') }}</td>
    <td class="col-1">{{ $reservation->date_end->format('Y-m-d') }}</td>
    <td class="col-2">{{ $reservation->created_at->format('Y-m-d H:i:s') }}</td>
</tr>
