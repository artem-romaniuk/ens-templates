@extends('themes.' . current_theme() . '.layouts.main')

@push('scripts')
    <script>
        $('.search-input').on('search', function(e) {
            if ('' === this.value) {
                $(this).parent('form').submit();
            }
        });
    </script>
@endpush

@section('content')
    <main class="main-content">
        @if (! empty($data['banner']))
            @php($banner = $data['banner'][0])
            <div class="section page-header-area" @if (! empty($banner['image']['url'])) data-bg-img="'{{ $banner['image']['url'] }}'" @endif
                style="@if (empty($banner['image']['url'])) padding: 0px 0px 20px 0px !important; @endif">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-auto text-center text-sm-start">
                            <h1 
                                class="page-header-title" 
                                style="
                                    @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif 
                                    @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                                {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                            </h1>
                            @if (! empty($banner['subtitle']['text']))
                                <p 
                                    class="link-nav" 
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
        @endif

        @if (! empty($events))
            <div class="event-section section section-padding pb-0">
                <div class="container">
                    <div class="row justify-content-between flex-xl-row-reverse">
                        <div class="col-lg-12 col-xl-8">
                            @foreach($events as $event)
                                <div class="col-12 mb-6">
                                    <div class="event-item flex-md-nowrap flex-sm-wrap">
                                        @php($image = $event->data['image']['url'] ?? null)
                                        @if ($image)
                                            <a href="{{ route('events.single', $event->slug) }}" class="image">
                                                <img src="{{ $image }}" width="350" height="315" alt="{{ $event->title ?? $event->name }}">
                                            </a>
                                        @endif

                                        <div class="content p-5">
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
                                                    <a href="{{ route('events.single', $event->slug) }}">
                                                        {{ $event->title ?? $event->name }}
                                                    </a>
                                                </h4>
                                                @if (! empty($event->description))
                                                    {!! $event->description !!}
                                                @endif

                                                <div class="button">
                                                    <a class="btn btn-primary btn-icon-right btn-lg" href="{{ route('events.single', $event->slug) }}">
                                                        <span>Click here for more information</span> <i class="icofont-double-right icon"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if ($events->lastPage() > 1)
                                <div class="col-12">
                                    <div class="mt-6 mt-md-10">
                                        {{ $events->onEachSide(2)->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-12 col-xl-4">
                            <div class="sidebar-wrap mt-8 mt-xl-0 pe-0 pe-xl-6">
                                <div class="sidebar-search-widget">
                                    <form action="{{ route('events.list') }}" method="get">
                                        <input class="form-control search-input" name="search" type="search" placeholder="Search here" value="{{ request('search') }}">
                                        @foreach(array_filter(request()->query() ?? []) as $name => $value)
                                            @continue($name == 'search')
                                            <input name="{{ $name }}" type="hidden" value="{{ $value }}">
                                        @endforeach
                                        <button type="submit"><i class="icofont-search-1"></i></button>
                                    </form>
                                </div>

                                @if ($categories->isNotEmpty())
                                    <div class="sidebar-widget">
                                        <h3 class="sidebar-widget-title">Categories</h3>
                                        <div class="sidebar-widget-body">
                                            <ul class="sidebar-category-list">
                                                @if (settings('events_setup.categories_listed') == 'first')
                                                    <li>
                                                        <a class="custom-link" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                            All categories
                                                        </a>
                                                    </li>
                                                @endif
                                                @foreach($categories as $category)
                                                    <li>
                                                        <a class="custom-link" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'page' => 1])) }}" @if (request('category') == $category->id) class="active" @endif>
                                                            {{ $category->name }} <span>({{ $category->events_count }})</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                                @if (settings('events_setup.categories_listed') == 'last')
                                                    <li>
                                                        <a class="custom-link" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                            All categories
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <div class="sidebar-widget">
                                    <h3 class="sidebar-widget-title">Timeframe</h3>
                                    <div class="sidebar-widget-body">
                                        <ul class="sidebar-category-list">
                                            <li>
                                                <a class="custom-link" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 1, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 1) class="active" @endif>
                                                    Within 1 month
                                                </a>
                                            </li>
                                            <li>
                                                <a class="custom-link" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 3, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 3) class="active" @endif>
                                                    Within 3 month
                                                </a>
                                            </li>
                                            <li>
                                                <a class="custom-link" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 6, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 6) class="active" @endif>
                                                    Within 6 month
                                                </a>
                                            </li>
                                            <li>
                                                <a class="custom-link" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 12, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 12) class="active" @endif>
                                                    Within 12 month
                                                </a>
                                            </li>
                                            <li>
                                                <a class="custom-link" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => 0, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == 0) class="active" @endif>
                                                    All Upcoming
                                                </a>
                                            </li>
                                            <li>
                                                <a class="custom-link" href="{{ route('events.list', array_merge(array_filter(request()->query()), ['timeframe' => -1, 'page' => 1])) }}" @if (request('timeframe', settings('events_setup.default_timeframe', 0)) == -1) class="active" @endif>
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
            </div>
        @endif

       <section class="container py-0 page-content">
           @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection
