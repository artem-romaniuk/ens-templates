<div class="col-lg-6">
    <article class="d-flex flex-column event-block">
        @php($image = $event->data['image']['url'] ?? null)
        @if ($image)
            <div class="post-img">
                <img src="{{ $image }}" alt="{{ $event->name }}" class="img-fluid">
            </div>
        @endif

        <h2 class="title">
            <a href="{{ route('events.single', $event->slug) }}">{{ $event->name }}</a>
        </h2>

        <div class="meta-top">
            <ul>
                <li class="d-flex align-items-center">{{ $event->start_at?->format('F d, Y') ?? '' }}</li>
                <li class="d-flex align-items-center">{{ $event->start_at?->format('h:i A') ?? '' }}</li>
            </ul>
            <ul>
                @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                    <li class="d-flex align-items-center">{{ $event->end_at?->format('F d, Y') ?? '' }}</li>
                @endif
                @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                    <li class="d-flex align-items-center">{{ $event->end_at?->format('h:i A') ?? '' }}</li>
                @endif
            </ul>
        </div>

        <div class="content">
            @if (! empty($event->location))
                <p class="event-location">{{ $event->location }}</p>
            @endif

            @if (! empty($event->description))
                <div class="event-short-description">
                    {!! $event->description !!}
                </div>
            @endif
        </div>

        <div class="read-more mt-auto align-self-end pt-4">
            <a href="{{ route('events.single', $event->slug) }}">Details <i class="bi bi-arrow-right"></i></a>
        </div>
    </article>
</div>
