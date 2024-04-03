@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div class="shows-events-tabs rent-venue-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tabs-content my-4 py-3">
                    <div class="row" style="background: #e9eef5">
                        <div class="col-lg-6 wow fadeInRight">
                            @php($image = $event->data['image']['url'] ?? null)
                            @if ($image)
                                <div class="img-fluid py-3 text-center">
                                    <img src="{{ $image }}" style="width: 100%; height: auto" alt="{{ $event->title ?? $event->name }}">
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6 py-3 wow fadeInUp">
                            @if (($event->start_at?->format('F d, Y') ?? '') == ($event->end_at?->format('F d, Y') ?? ''))
                                <div class="date mb-1"><b>Date:</b> {{ $event->end_at?->format('F d, Y') ?? '' }}</div>
                            @else
                                <div class="date mb-1"><b>Dates:</b> {{ ($event->start_at?->format('F d, Y') ?? '') . ' to ' . ($event->end_at?->format('F d, Y') ?? '') }}</div>
                            @endif

                            @if (($event->start_at?->format('h:i A') ?? '') == ($event->end_at?->format('h:i A') ?? ''))
                                <div class="date mb-1"><b>Time:</b> {{ $event->end_at?->format('h:i A') ?? '' }}</div>
                            @else
                                <div class="date mb-1"><b>Time:</b> {{ ($event->start_at?->format('h:i A') ?? '') . ' to ' . ($event->end_at?->format('h:i A') ?? '') }}</div>
                            @endif

                            @if (! empty($event->location))
                                <div class="location mb-3"><b>Location:</b> {{ $event->location }}</div>
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
    </div>

    <div class="shows-events-tabs rent-venue-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tabs-content mt-0 mb-4 pt-3 page-content" style="background: white">
                @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])

                <div style="width: 100%" class="text-center py-4">
                    <a href="{{ url()->previous() }}" class="btn btn-success">
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
    </div>
@endsection
