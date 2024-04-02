@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <header>
        @include('themes.' . current_theme() . '.layouts.includes.header')

        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="page-banner" style="background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); background-size: cover; @if(empty($data['banner'][0]['image']['url'])) height: 150px; @endif">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-md-6">
                        <nav aria-label="Breadcrumb">
                            <ul class="breadcrumb justify-content-center py-0 bg-transparent">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">{{ $name ?? '' }}</li>
                            </ul>
                        </nav>
                        <h1 
                            class="text-center" 
                            style="
                                @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                                @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                            {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                        </h1>

                        @if (! empty($banner['subtitle']['text']))
                            <p 
                                class="text-center"
                                style="
                                    @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                    @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                                {{ $banner['subtitle']['text'] }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="page-section pt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @if (! empty($events))
                            @foreach($events as $event)
                                <div class="col-lg-4 py-4 wow fadeInUp">
                                    <div class="card-blog">
                                        @php($image = $event->data['image']['url'] ?? null)
                                        @if ($image)
                                            <div class="header">
                                                <div class="post-thumb" style="background-image: url('{{ $image }}'); background-position: center center; background-size: cover;">
{{--                                                    <img src="../assets/img/blog/blog-2.jpg" alt="">--}}
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

{{--                                            @if (! empty($event->description))--}}
{{--                                                <div class="event-short-description">--}}
{{--                                                    {!! $event->description !!}--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @if ($events->lastPage() > 1)
                        <nav aria-label="Page Navigation">
                            {{ $events->onEachSide(2)->appends(request()->query())->links('vendor.pagination.shadow') }}
                        </nav>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="widget pt-3">
                        <div class="widget-box">
                            <form action="{{ route('events.list') }}" class="search-widget" method="get">
                                <input type="text" name="search" class="form-control" placeholder="Enter keyword.." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </form>
                        </div>

                        @if (isset($categories) && $categories->isNotEmpty())
                            <div class="widget-box">
                                <h4 class="widget-title">Category</h4>
                                <div class="divider"></div>

                                <ul class="categories">
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

                        <div class="widget-box">
                            <h4 class="widget-title">Timeframe</h4>
                            <div class="divider"></div>

                            <ul class="categories">
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
    </div>

    <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
@endsection
