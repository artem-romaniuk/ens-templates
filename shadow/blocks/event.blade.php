<div class="col-lg-4 py-4 wow fadeInUp">
    <div class="card-blog event-block">
        @php($image = $event->data['image']['url'] ?? null)
        @if ($image)
            <div class="header">
                <div class="post-thumb" style="background-image: url('{{ $image }}'); background-position: center center; background-size: cover;">
{{--                    <img src="../assets/img/blog/blog-2.jpg" alt="">--}}
                </div>
            </div>
        @endif
        <div class="body">
            <h5 class="post-title entry-title">
                <a href="{{ route('events.single', $event->slug) }}">{{ $event->name }}</a>
            </h5>

            @if (! empty($event->location))
                <p class="event-location">{{ $event->location }}</p>
            @endif

            <div class="post-date">{{ $event->start_at?->format('F d, Y') ?? '' }} {{ $event->start_at?->format('h:i A') ?? '' }}</div>

            <div class="post-date" style="height: 20px">
                @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                    {{ $event->end_at?->format('F d, Y') ?? '' }}

                    @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                        {{ $event->end_at?->format('h:i A') ?? '' }}
                    @endif
                @endif
            </div>

{{--            @if (! empty($event->description))--}}
{{--                <div class="event-short-description">--}}
{{--                    {!! $event->description !!}--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>
    </div>
</div>
