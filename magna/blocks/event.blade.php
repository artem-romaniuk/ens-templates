<div class="col-md-6 col-xl-6 mb-6 blog py-0 px-2">
    <article class="entry event-block">
        @php($image = $event->data['image']['url'] ?? null)
        @if ($image)
            <div class="entry-img" style="background-image: url('{{ $image }}')">
{{--                <img src="{{ $image }}" alt="" class="img-fluid">--}}
            </div>
        @endif

        <h2 class="entry-title">
            <a href="{{ route('events.single', $event->slug) }}">{{ $event->name }}</a>
        </h2>

        <div class="entry-meta">
            <ul>
                <li>{{ $event->start_at?->format('F d, Y') ?? '' }}</li>
                <li>{{ $event->start_at?->format('h:i A') ?? '' }}</li>
            </ul>
            <ul>
                @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                    <li>{{ $event->end_at?->format('F d, Y') ?? '' }}</li>
                @endif
                @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                    <li>{{ $event->end_at?->format('h:i A') ?? '' }}</li>
                @endif
            </ul>
        </div>

        <div class="entry-content">
            @if (! empty($event->location))
                <p class="event-location">{{ $event->location }}</p>
            @endif

            @if (! empty($event->description))
                <div class="event-short-description">
                    {!! $event->description !!}
                </div>
            @endif

            <div class="read-more mt-4">
                <a href="{{ route('events.single', $event->slug) }}">Details</a>
            </div>
        </div>
    </article>
</div>
