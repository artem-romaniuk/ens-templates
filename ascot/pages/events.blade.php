@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div class="page-heading-rent-venue" 
            style="
            background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); 
            background-size: cover;
            @if (empty($data['banner'][0]['image']['url'])) padding: 20px 0px !important; @endif">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center" 
                        style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h2>

                    @if (! empty($banner['subtitle']['text']))
                        <span style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="shows-events-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tabs-content mt-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="sidebar mb-4">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <form action="{{ route('events.list') }}" class="contact-form" method="get">
                                            <fieldset>
                                                <input type="text" name="search" class="mb-1" placeholder="Enter keyword.." value="{{ request('search') }}">
                                            </fieldset>
                                            <button type="submit" class="button" style="width: 100%; height: 38px; line-height: 8px">Search</button>
                                        </form>
                                    </div>

                                    @if (isset($categories) && $categories->isNotEmpty())
                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="mb-2">Category</h6>
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
                                        </div>
                                    @endif

                                    <div class="widget-box">
                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="mb-2">Timeframe</h6>

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
                        </div>

                        <div class="col-lg-9">
                            @if (! empty($events))
                                <div class="row tickets-page mb-0">
                                    @foreach($events as $event)
                                        <div class="col-lg-6">
                                            <div class="ticket-item">
                                                @php($image = $event->data['image']['url'] ?? null)
                                                @if ($image)
                                                    <div class="thumb post-thumb" style="background-image: url('{{ $image }}'); background-position: center center; background-size: cover;">

                                                    </div>
                                                @endif
                                                <div class="down-content pt-2">
                                                    <h4 class="mb-2 entry-title">{{ $event->name }}</h4>
                                                    <ul style="height: 85px">
                                                        <li>
                                                            <i class="fa fa-clock-o mt-1"></i>
                                                            {{ $event->start_at?->format('F d, Y') ?? '' }} {{ $event->start_at?->format('h:i A') ?? '' }}

                                                            @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                                                                - {{ $event->end_at?->format('F d, Y') ?? '' }}

                                                                @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                                                                    {{ $event->end_at?->format('h:i A') ?? '' }}
                                                                @endif
                                                            @endif
                                                        </li>

                                                        @if (! empty($event->location))
                                                            <li class="event-location"><i class="fa fa-map-marker"></i> {{ $event->location }}</li>
                                                        @endif
                                                    </ul>

                                                    <div class="main-dark-button mt-3">
                                                        <a href="{{ route('events.single', $event->slug) }}">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if ($events->lastPage() > 1)
                                        <div class="col-lg-12">
                                            <div class="pagination mt-2 mb-4">
                                                {{ $events->onEachSide(2)->appends(request()->query())->links('vendor.pagination.ascot') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
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
