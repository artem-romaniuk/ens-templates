@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <main class="main-content">
        <div class="event-section section section-padding pt-8 pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-6">
                        <div class="event-item flex-md-nowrap flex-sm-wrap">
                            @php($image = $event->data['image']['url'] ?? null)
                            @if ($image)
                                <div class="image">
                                    <img src="{{ $image }}" width="350" height="315" alt="{{ $event->title ?? $event->name }}">
                                </div>
                            @endif

                            <div class="content">
                                <div class="details" style="width: 100%">
                                    @if (($event->start_at?->format('F d, Y') ?? '') == ($event->end_at?->format('F d, Y') ?? ''))
                                        <span class="date"><span>Date:</span> {{ $event->end_at?->format('F d, Y') ?? '' }}</span>
                                    @else
                                        <span class="date"><span>Dates:</span> {{ ($event->start_at?->format('F d, Y') ?? '') . ' to ' . ($event->end_at?->format('F d, Y') ?? '') }}</span>
                                    @endif

                                    @if (($event->start_at?->format('h:i A') ?? '') == ($event->end_at?->format('h:i A') ?? ''))
                                        <span class="date"><span>Time:</span> {{ $event->end_at?->format('h:i A') ?? '' }}</span>
                                    @else
                                        <span class="date"><span>Time:</span> {{ ($event->start_at?->format('h:i A') ?? '') . ' to ' . ($event->end_at?->format('h:i A') ?? '') }}</span>
                                    @endif

                                    @if (! empty($event->location))
                                        <span class="location"><span>Location:</span> {{ $event->location }}</span>
                                    @endif
                                    <h4 class="title">
                                        {{ $event->title ?? $event->name }}
                                    </h4>
                                    @if (! empty($event->description))
                                        {!! $event->description !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="events-details-content">
                    @foreach($event->data['content']['blocks'] ?? [] as $block)
                        @includeif('themes.' . current_theme() . '.editor.blocks.' . $block['type'], ['data' => $block['data'], 'parameters' => $block['tunes']['parameters'] ?? null])
                    @endforeach

                    <div style="width:100%; margin-top: 45px;" class="text-center">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">
                            @if (substr(url()->previous(), 0, mb_strlen(route('events.list'))) == route('events.list'))
                                Return to Events Page
                            @else
                                Return to Previous Page
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
