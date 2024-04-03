@extends('themes.' . current_theme() . '.layouts.main')

@push('scripts')

@endpush

@section('content')
    <main id="main">
        @if (! empty($data['banner']))
            @php($banner = $data['banner'][0])
            <section class="d-flex justify-content-center flex-column align-items-center page-banner" style="background-image: url('{{ $banner['image']['url'] ?? '' }}'); @if(empty($banner['image']['url'])) height: 100px !important; padding: 30px 0px !important; @endif">
                <h2 
                    class="animate__animated animate__fadeInDown text-center" 
                    style="
                        @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                        @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                    {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                </h2>

                @if (! empty($banner['subtitle']['text']))
                    <p 
                        class="animate__animated animate__fadeInUp" 
                        style="
                            @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                            @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                        {{ $banner['subtitle']['text'] }}
                    </p>
                @endif
            </section>
        @endif

        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">{{ $name ?? '' }}</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{ $name ?? '' }}</li>
                    </ol>
                </div>
            </div>
        </section>

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-8 entries">
                        @if (! empty($events))
                            @foreach($events as $event)
                                <article class="entry">
                                    @php($image = $event->data['image']['url'] ?? null)
                                    @if ($image)
                                        <div class="entry-img" style="background-image: url('{{ $image }}')">
{{--                                            <img src="{{ $image }}" alt="" class="img-fluid">--}}
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
                            @endforeach
                        @endif

                        @if ($events->lastPage() > 1)
                            <div class="blog-pagination mb-4">
                                {{ $events->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="sidebar">
                            <h3 class="sidebar-title">Search</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('events.list') }}" method="get">
                                    <input type="text" name="search" value="{{ request('search') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>

                            @if (isset($categories) && $categories->isNotEmpty())
                                <h3 class="sidebar-title">Categories</h3>
                                <div class="sidebar-item categories">
                                    <ul>
                                        @if (settings('events_setup.categories_listed') == 'first')
                                            <li>
                                                <a href="{{ route('events.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                    All categories
                                                </a>
                                            </li>
                                        @endif
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ route('events.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'page' => 1])) }}" @if (request('category') == $category->id) class="active" @endif>
                                                    {{ $category->name }} <span>({{ $category->events_count }})</span>
                                                </a>
                                            </li>
                                        @endforeach
                                        @if (settings('events_setup.categories_listed') == 'last')
                                            <li>
                                                <a href="{{ route('events.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                    All categories
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif

                            <h3 class="sidebar-title">Timeframe</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    <li>
                                        <a href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 1, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 1) class="active" @endif>
                                            Within 1 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 3, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 3) class="active" @endif>
                                            Within 3 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 6, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 6) class="active" @endif>
                                            Within 6 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 12, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 12) class="active" @endif>
                                            Within 12 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 0, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 0) class="active" @endif>
                                            All Upcoming
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => -1, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == -1) class="active" @endif>
                                            History of past events
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection
