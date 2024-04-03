@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'page-blog')

@section('content')
    <main id="main">
        @if (! empty($data['banner']))
            @php($banner = $data['banner'][0])
            <div class="breadcrumbs d-flex align-items-center" style="
                background-image: url('{{ $banner['image']['url'] ?? '' }}'); 
                @if(empty($banner['image']['url'])) padding: 85px 0 20px 0; @endif 
                @if(($template_settings['header']['logo_position']['value'] ?? '') == 'under_menu' && ! empty($template_settings['header']['logo_position']['apply'])) padding: 130px 0 20px 0; @endif">
                <div class="container position-relative d-flex flex-column align-items-center">

                    <h2 style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h2>

                    @if (! empty($banner['subtitle']['text']))
                        <p style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </p>
                    @endif

                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{  $name ?? '' }}</li>
                    </ol>
                </div>
            </div>
        @endif

        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <div class="row g-5">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        @if (! empty($events))
                            <div class="row gy-5 posts-list">
                                @foreach($events as $event)
                                    <div class="col-lg-6">
                                        <article class="d-flex flex-column">
                                            @php($image = $event->data['image']['url'] ?? null)
                                            @if ($image)
                                                <div class="post-img" style="background-image: url('{{ $image }}')">
{{--                                                    <img src="{{ $image }}" alt="{{ $event->name }}" class="img-fluid">--}}
                                                </div>
                                            @endif

                                            <h2 class="title">
                                                <a href="{{ route('events.single', $event->slug) }}">{{ $event->name }}</a>
                                            </h2>

                                            <div class="meta-top">
                                                <ul>
                                                    <li class="d-flex align-items-center">{{ $event->start_at?->format('F d, Y') ?? '' }}</li>
                                                    <li class="d-flex align-items-center">{{ $event->start_at?->format('h:i A') ?? '' }}</li>
                                                </ul>
                                                <ul>
                                                    @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                                                        <li class="d-flex align-items-center">{{ $event->end_at?->format('F d, Y') ?? '' }}</li>
                                                    @endif
                                                    @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                                                        <li class="d-flex align-items-center">{{ $event->end_at?->format('h:i A') ?? '' }}</li>
                                                    @endif
                                                </ul>
                                            </div>

                                            <div class="content">
                                                @if (! empty($event->location))
                                                    <p class="event-location">{{ $event->location }}</p>
                                                @endif

                                                @if (! empty($event->description))
                                                    <div class="event-short-description">
                                                        {!! $event->description !!}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="read-more mt-auto align-self-end pt-4">
                                                <a href="{{ route('events.single', $event->slug) }}">Details <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if ($events->lastPage() > 1)
                            <div class="blog-pagination mb-4">
                                {{ $events->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="sidebar ps-lg-4">
                            <div class="sidebar-item search-form">
                                <h3 class="sidebar-title">Search</h3>
                                <form action="{{ route('events.list') }}" method="get">
                                    <input type="text" name="search" value="{{ request('search') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>

                            @if (isset($categories) && $categories->isNotEmpty())
                                <div class="sidebar-item categories">
                                    <h3 class="sidebar-title">Categories</h3>
                                    <ul class="mt-3">
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

                            <div class="sidebar-item categories">
                                <h3 class="sidebar-title">Timeframe</h3>
                                <ul class="mt-3">
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
