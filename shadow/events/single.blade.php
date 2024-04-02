@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <div class="hero_area">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')

    </div>

    <div class="page-section pt-4 pb-0">
        <div class="container">
            <nav aria-label="Breadcrumb">
                <ul class="breadcrumb p-0 mb-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pages.single', 'events') }}">Events</a></li>
                    <li class="breadcrumb-item active">{{ $event->title ?? $event->name }}</li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="page-section pb-4 pt-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 py-3 wow fadeInRight">
                    @php($image = $event->data['image']['url'] ?? null)
                    @if ($image)
                        <div class="img-fluid py-3 text-center">
                            <img src="{{ $image }}" style="width: 100%; height: auto" alt="{{ $event->title ?? $event->name }}">
                        </div>
                    @endif
                </div>
                <div class="col-lg-6 py-3 wow fadeInUp">
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

    <section class="page-section py-0">
        <div class="container">
            <div class="row page-content">
                @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])

                <div style="width: 100%" class="button text-center py-4 mb-4">
                    <a href="{{ url()->previous() }}" class="btn btn-primary ml-lg-2">
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
