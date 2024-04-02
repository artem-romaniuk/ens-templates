<div class="col-lg-4">
    <div class="ticket-item">
        @php($image = $event->data['image']['url'] ?? null)
        @if ($image)
            <div class="thumb post-thumb" style="background-image: url('{{ $image }}'); background-position: center center; background-size: cover;">

            </div>
        @endif
        <div class="down-content pt-2 event-block">
            <h4 class="mb-2 entry-title"><a href="{{ route('events.single', $event->slug) }}">{{ $event->name }}</a></h4>
            <ul style="height: 85px">
                <li>
                    <i class="fa fa-clock-o mt-1"></i>
                    {{ $event->start_at?->format('F d, Y') ?? '' }} {{ $event->start_at?->format('h:i A') ?? '' }}

                    @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                        - {{ $event->end_at?->format('F d, Y') ?? '' }}

                        @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                            {{ $event->end_at?->format('h:i A') ?? '' }}
                        @endif
                    @endif
                </li>

                @if (! empty($event->location))
                    <li class="event-location"><i class="fa fa-map-marker"></i> {{ $event->location }}</li>
                @endif
            </ul>

            <div class="main-dark-button mt-3">
                <a href="{{ route('events.single', $event->slug) }}">Details</a>
            </div>
        </div>
    </div>
</div>
