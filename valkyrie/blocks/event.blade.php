<div class="col-12 col-md-4 mb-4">
    <div class="card h-100 event-block">
        @php($image = $event->data['image']['url'] ?? null)
        @if ($image)
            <a href="{{ route('events.single', $event->slug) }}" class="post-thumb" style="background-image: url('{{ $image }}'); background-position: center center; background-size: cover;">

            </a>
        @endif

        <div class="card-body">
            <ul class="list-unstyled d-flex justify-content-between">
                <li class="text-muted">{{ $event->start_at?->format('F d, Y') ?? '' }}</li>
                <li class="text-muted text-right">{{ $event->start_at?->format('h:i A') ?? '' }}</li>
            </ul>

            <ul class="list-unstyled d-flex justify-content-between" style="height: 28px;">
                @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                    <li class="text-muted">{{ $event->end_at?->format('F d, Y') ?? '' }}</li>

                    @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                        <li class="text-muted text-right">{{ $event->end_at?->format('h:i A') ?? '' }}</li>
                    @endif
                @endif
            </ul>

            <a href="{{ route('events.single', $event->slug) }}" class="h2 text-decoration-none text-dark entry-title">{{ $event->name }}</a>

            @if (! empty($event->location))
                <div class="card-text post-short-description mt-2">{{ $event->location }}</div>
            @endif

            <div class="mt-3">
                <a href="{{ route('events.single', $event->slug) }}" class="text-muted entry-title">Details</a>
            </div>
        </div>
    </div>
</div>
