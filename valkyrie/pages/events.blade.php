@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <section class="bg-success py-5" style="background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); background-size: cover;">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row align-items-center py-5">
                <div class="col-md-12 text-white">
                    <h1 style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h1>

                    @if (! empty($banner['subtitle']['text']))
                        <h3 style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </h3>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="shows-events-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tabs-content mt-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="sidebar mb-4">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <form action="{{ route('events.list') }}" class="contact-form" method="get">
                                            <fieldset>
                                                <input type="text" name="search" class="form-control mb-2" placeholder="Enter keyword.." value="{{ request('search') }}">
                                            </fieldset>
                                            <button type="submit" class="btn btn-success" style="width: 100%; height: 38px; line-height: 8px">Search</button>
                                        </form>
                                    </div>

                                    @if (isset($categories) && $categories->isNotEmpty())
                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="h2 mb-2">Category</h6>
                                                <ul class="list-unstyled pl-3">
                                                    @if (settings('events_setup.categories_listed') == 'first')
                                                        <li class="mb-1">
                                                            <a class="text-decoration-none" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                                All categories
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @foreach($categories as $category)
                                                        <li class="mb-1">
                                                            <a class="text-decoration-none" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'page' => 1])) }}" @if (request('category') == $category->id) class="active" @endif>
                                                                {{ $category->name }} <span>({{ $category->events_count }})</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                    @if (settings('events_setup.categories_listed') == 'last')
                                                        <li class="mb-1">
                                                            <a class="text-decoration-none" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                                All categories
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-lg-12">
                                        <div class="category">
                                            <h6 class="h2 mb-2">Timeframe</h6>
                                            <ul class="list-unstyled pl-3">
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 1, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 1) class="active" @endif>
                                                        Within 1 month
                                                    </a>
                                                </li>
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 3, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 3) class="active" @endif>
                                                        Within 3 month
                                                    </a>
                                                </li>
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 6, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 6) class="active" @endif>
                                                        Within 6 month
                                                    </a>
                                                </li>
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 12, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 12) class="active" @endif>
                                                        Within 12 month
                                                    </a>
                                                </li>
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 0, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 0) class="active" @endif>
                                                        All Upcoming
                                                    </a>
                                                </li>
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => -1, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == -1) class="active" @endif>
                                                        History of past events
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            @if (! empty($events))
                                <div class="row">
                                    @foreach($events as $event)
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="card h-100">
                                                @php($image = $event->data['image']['url'] ?? null)
                                                @if ($image)
                                                    <a href="{{ route('events.single', $event->slug) }}" class="post-thumb" style="background-image: url('{{ $image }}'); background-position: center center; background-size: cover;">

                                                    </a>
                                                @endif

                                                <div class="card-body">
                                                    <ul class="list-unstyled d-flex justify-content-between">
                                                        <li class="text-muted">{{ $event->start_at?->format('F d, Y') ?? '' }}</li>
                                                        <li class="text-muted text-right">{{ $event->start_at?->format('h:i A') ?? '' }}</li>
                                                    </ul>

                                                    <ul class="list-unstyled d-flex justify-content-between" style="height: 28px;">
                                                        @if (($event->start_at?->format('F d, Y') ?? '') != ($event->end_at?->format('F d, Y') ?? ''))
                                                            <li class="text-muted">{{ $event->end_at?->format('F d, Y') ?? '' }}</li>

                                                            @if (($event->start_at?->format('h:i A') ?? '') != ($event->end_at?->format('h:i A') ?? ''))
                                                                <li class="text-muted text-right">{{ $event->end_at?->format('h:i A') ?? '' }}</li>
                                                            @endif
                                                        @endif
                                                    </ul>

                                                    <a href="{{ route('events.single', $event->slug) }}" class="h2 text-decoration-none text-dark entry-title">{{ $event->name }}</a>

                                                    @if (! empty($event->location))
                                                        <div class="card-text post-short-description mt-2">{{ $event->location }}</div>
                                                    @endif

                                                    <div class="mt-3">
                                                        <a href="{{ route('events.single', $event->slug) }}" class="text-muted entry-title">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @if ($events->lastPage() > 1)
                                        {{ $events->onEachSide(2)->appends(request()->query())->links('vendor.pagination.valkyrie') }}
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
