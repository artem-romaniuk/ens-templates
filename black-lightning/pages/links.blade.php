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

        @if (! empty($links))
            <div class="event-section section section-padding pb-0">
                <div class="container">
                    <div class="row justify-content-between flex-xl-row-reverse">
                        <div class="col-lg-12 col-xl-8">
                            @foreach($links as $link)
                                <div class="col-12 mb-6">
                                    <div class="event-item flex-md-nowrap flex-sm-wrap">
                                        <div class="content p-5">
                                            <div class="details" style="width: 100%">
                                                <h4 class="title">
                                                    @if ($link->type == \App\Enums\LinkType::URL->value)
                                                        <a href="{{ $link->link }}" target="_blank" rel="nofollow">
                                                            {{ $link->title ?? $link->name }}
                                                        </a>
                                                    @endif

                                                    @if ($link->type == \App\Enums\LinkType::EMAIL->value)
                                                        <a href="mailto:{{ $link->link }}" target="_blank" rel="nofollow">
                                                            {{ $link->title ?? $link->name }}
                                                        </a>
                                                    @endif
                                                </h4>

                                                <div>
                                                    {!! $link->description !!}
                                                </div>
                                                <div class="sub-title">
                                                    @if ($link->type == \App\Enums\LinkType::URL->value)
                                                        <a href="{{ $link->link }}" target="_blank" rel="nofollow">
                                                            {{ str_replace(['http://', 'https://'], '', rtrim($link->link, '/')) }}
                                                        </a>
                                                    @endif

                                                    @if ($link->type == \App\Enums\LinkType::EMAIL->value)
                                                        <a href="mailto:{{ $link->link }}" target="_blank" rel="nofollow">
                                                            {{ $link->link }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if ($links->lastPage() > 1)
                                <div class="col-12">
                                    <div class="mt-6 mt-md-10">
                                        {{ $links->onEachSide(2)->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-12 col-xl-4">
                            <div class="sidebar-wrap mt-8 mt-xl-0 pe-0 pe-xl-6">
                                <div class="sidebar-search-widget">
                                    <form action="{{ route('links.list') }}" method="get">
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
                                                <li>
                                                    <a class="custom-link" href="{{ route('links.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                        All categories
                                                    </a>
                                                </li>
                                                @foreach($categories as $category)
                                                    <li>
                                                        <a class="custom-link" href="{{ route('links.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'page' => 1])) }}" @if (request('category') == $category->id) class="active" @endif>
                                                            {{ $category->name }} <span>({{ $category->links_count }})</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <div class="sidebar-widget">
                                    <h3 class="sidebar-widget-title">Timeframe</h3>
                                    <div class="sidebar-widget-body">
                                        <ul class="sidebar-category-list">
                                            <li>
                                                <a class="custom-link" href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 0, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 0) class="active" @endif>
                                                    All
                                                </a>
                                            </li>
                                            <li>
                                                <a class="custom-link" href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 1, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 1) class="active" @endif>
                                                    1 month
                                                </a>
                                            </li>
                                            <li>
                                                <a class="custom-link" href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 3, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 3) class="active" @endif>
                                                    3 month
                                                </a>
                                            </li>
                                            <li>
                                                <a class="custom-link" href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 6, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 6) class="active" @endif>
                                                    6 month
                                                </a>
                                            </li>
                                            <li>
                                                <a class="custom-link" href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 12, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 12) class="active" @endif>
                                                    12 month
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
