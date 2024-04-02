<div class="col-lg-4 service_section mt-3">
    <div class="box mt-0 mb-2 service_container pt-4 pb-4 event-block" style="margin: 0">
        @php($image = $event->data['image']['url'] ?? null)
        @if ($image)
            <div class="entry-img" style="background-image: url('{{ $image }}')">
            </div>
        @endif

        <div class="detail-box">
            <h5 class="entry-title">
                <a href="{{ route('events.single', $event->slug) }}">{{ $event->name }}</a>
            </h5>
            <div class="meta-top entry-meta" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                <ul style="padding: 0">
                    <li>{{ $event->start_at?->format('F d, Y') ?? '' }}</li>
                    <li>{{ $event->start_at?->format('h:i A') ?? '' }}</li>
                </ul>
                <ul style="padding: 0">
                    @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                        <li>{{ $event->end_at?->format('F d, Y') ?? '' }}</li>
                    @endif
                    @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                        <li>{{ $event->end_at?->format('h:i A') ?? '' }}</li>
                    @endif
                </ul>
            </div>

            @if (! empty($event->location))
                <p class="event-location">{{ $event->location }}</p>
            @endif

            @if (! empty($event->description))
                <div class="event-short-description">
                    {!! $event->description !!}
                </div>
            @endif

            <a href="{{ route('events.single', $event->slug) }}" class="mt-2 d-block button">Details</a>
        </div>
    </div>
</div>
