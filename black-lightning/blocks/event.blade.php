<div class="col-md-6 col-xl-4 mb-6">
    <div class="post-item post3-item-style">
        @php($image = $event->data['image']['url'] ?? null)
        @if ($image)
            <a
                href="{{ route('events.single', $event->slug) }}"
                class="image d-block"
                style="background-image: url('{{ $image }}');background-size:cover;background-position:center;height:250px;width:100%"
            >
            </a>
        @endif

        <div class="content event-block">
            <ul class="post-meta post3-meta pb-1">
                <li class="post-date">{{ $event->start_at?->format('F d, Y') ?? '' }}</li>
                <li class="post-date">{{ $event->start_at?->format('h:i A') ?? '' }}</li>
            </ul>
            <ul class="post-meta post3-meta pb-1">
                @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                    <li class="post-date">{{ $event->end_at?->format('F d, Y') ?? '' }}</li>
                @endif
                @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                    <li class="post-date">{{ $event->end_at?->format('h:i A') ?? '' }}</li>
                @endif
            </ul>
            <h4 class="title">
                <a class="default-link" href="{{ route('events.single', $event->slug) }}">
                    {{ $event->name }}
                </a>
            </h4>

            @if (! empty($event->location))
                <p class="event-location">{{ $event->location }}</p>
            @endif

            <div class="event-short-description">
                @if (! empty($event->description))
                    {!! $event->description !!}
                @endif
            </div>
        </div>
    </div>
</div>
