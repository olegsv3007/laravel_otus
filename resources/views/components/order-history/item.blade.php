
@props(['reservation'])

<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ $reservation->apartment->mainImageSrc }}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $reservation->apartment->title }}
                    <span class="badge rounded-pill text-white ml-2 badge-{{ $reservation->status->bootstrapClass }}">
                        {{ $reservation->status->title }}
                    </span>
                </h5>
                <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/order_history.city') }}:</span><span class="ml-2">{{ $reservation->apartment->hotel->city->name }}</span></p>
                <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/order_history.dates') }}:</span><span class="ml-2">{{ $reservation->date_start->isoFormat('MMMM Do YYYY') }} - {{ $reservation->date_end->isoFormat('MMMM Do YYYY') }}</span></p>
                <p class="card-text mb-1"><span class="font-weight-bold">{{ __('public/pages/order_history.price') }}:</span><span class="ml-2">$ {{ $reservation->price }}</span></p>
                <div class="row justify-content-between align-items-end m-1 mt-4">
                    <div><small class="text-muted">{{ __('public/pages/order_history.order_was_created') }} {{$reservation->created_at}}</small></div>
                    <a type="button" class="btn btn-danger" href="#">{{ __('public/pages/order_history.button_cancel_order_title') }}</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
