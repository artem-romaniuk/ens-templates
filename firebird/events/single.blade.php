@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <div class="hero_area">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')
    </div>

    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pt-4">
                    <section class="service_section">
                        <div class="service_container">
                            <div class="container ">
                                <div class="row align-items-center" data-aos="fade-up">
                                    <div class="col-md-5">
                                        @php($image = $event->data['image']['url'] ?? null)
                                        @if ($image)
                                            <div class="image mb-4">
                                                <img src="{{ $image }}" style="width: 100%; height: auto" alt="{{ $event->title ?? $event->name }}">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-7">
                                        <div class="details" style="width: 100%">
                                            @if (($event->start_at?->format('F d, Y') ?? '') == ($event->end_at?->format('F d, Y') ?? ''))
                                                <div class="date mb-3"><b>Date:</b> {{ $event->end_at?->format('F d, Y') ?? '' }}</div>
                                            @else
                                                <div class="date mb-3"><b>Dates:</b> {{ ($event->start_at?->format('F d, Y') ?? '') . ' to ' . ($event->end_at?->format('F d, Y') ?? '') }}</div>
                                            @endif

                                            @if (($event->start_at?->format('h:i A') ?? '') == ($event->end_at?->format('h:i A') ?? ''))
                                                <div class="date mb-3"><b>Time:</b> {{ $event->end_at?->format('h:i A') ?? '' }}</div>
                                            @else
                                                <div class="date mb-3"><b>Time:</b> {{ ($event->start_at?->format('h:i A') ?? '') . ' to ' . ($event->end_at?->format('h:i A') ?? '') }}</div>
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
                    </section>
                </div>
            </div>
        </div>
    </section>

    <section class="py-0">
        <div class="container">
            <div class="row page-content">
                @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])

                <div style="width: 100%" class="button text-center py-4 mb-4">
                    <a href="{{ url()->previous() }}" class="cta-btn">
                        @if (substr(url()->previous(), 0, mb_strlen(route('events.list'))) == route('events.list'))
                            Return to Events Page
                        @else
                            Return to Previous Page
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
