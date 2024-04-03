@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'page-services')

@section('content')
    <main id="main">
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('{{ $event->data['image']['url'] ?? '' }}');">
            <div class="container position-relative d-flex flex-column align-items-center">
                <h2>{{ $title ?? $name ?? '' }}</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $event->title ?? $event->name ?? '' }}</li>
                </ol>
            </div>
        </div>

        <section id="services-cards" class="services-cards">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">
                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-item">
                            <div class="row">
                                @php($image = $event->data['image']['url'] ?? null)
                                <div class="col-xl-5">
                                    @if ($image)
                                        <div class="card-bg" style="background-image: url({{ $image }}); height: 100%"></div>
                                    @endif
                                </div>
                                <div class="col-xl-7 d-flex align-items-center">
                                    <div class="card-body">
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

                                        <h4 class="card-title mt-4">{{ $event->title ?? $event->name }}</h4>
                                        @if (! empty($event->description))
                                            <p>{!! $event->description !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row g-5">
                    <div class="col-lg-12 page-content" data-aos="fade-up" data-aos-delay="200">
                        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' =>  $content ?? ''])

                        <div style="width:100%" class="button text-center my-4">
                            <a href="{{ url()->previous() }}" style="background: none !important;" class="return-to-page">
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
        </section>
    </main>
@endsection
