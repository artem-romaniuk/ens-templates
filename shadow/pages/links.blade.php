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
        <div style="
                @if( empty(settings('logo_settings.header.height')) || settings('logo_settings.header.height') == 'auto') padding-top: 0; @endif
                @if(  settings('logo_settings.header.height') == 50) padding-top: 3%; @endif
                @if(  settings('logo_settings.header.height') == 100) padding-top: 3.5%; @endif
                @if(  settings('logo_settings.header.height') == 150) padding-top: 6%; @endif
                @if(  settings('logo_settings.header.height') == 200) padding-top: 8%; @endif
                @if(  settings('logo_settings.header.height') == 250) padding-top: 11.5%; @endif
            ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            @if (! empty($links))
                                @foreach($links as $link)
                                    <div class="col-lg-12 py-4 wow fadeInUp">
                                        <div class="card-blog" style="min-width: 100%">
                                            <div class="body">
                                                <h5 class="post-title entry-title">
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
                                                </h5>

                                                <div class="description">{!! $link->description !!}</div>

                                                @if ($link->type == \App\Enums\LinkType::URL->value)
                                                    <a class="link" href="{{ $link->link }}" target="_blank" rel="nofollow">
                                                        {{ str_replace(['http://', 'https://'], '', rtrim($link->link, '/')) }}
                                                    </a>
                                                @endif

                                                @if ($link->type == \App\Enums\LinkType::EMAIL->value)
                                                    <a class="link" href="mailto:{{ $link->link }}" target="_blank" rel="nofollow">
                                                        {{ $link->link }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        @if ($links->lastPage() > 1)
                            <nav aria-label="Page Navigation">
                                {{ $links->onEachSide(2)->appends(request()->query())->links('vendor.pagination.shadow') }}
                            </nav>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="widget pt-3">
                            <div class="widget-box">
                                <form action="{{ route('links.list') }}" class="search-widget" method="get">
                                    <input type="text" name="search" class="form-control" placeholder="Enter keyword.." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                                </form>
                            </div>

                            @if (isset($categories) && $categories->isNotEmpty())
                                <div class="widget-box">
                                    <h4 class="widget-title">Category</h4>
                                    <div class="divider"></div>

                                    <ul class="categories">
                                        <li>
                                            <a href="{{ route('links.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                All categories
                                            </a>
                                        </li>
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ route('links.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'page' => 1])) }}" @if (request('category') == $category->id) class="active" @endif>
                                                    {{ $category->name }} <span>({{ $category->links_count }})</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="widget-box">
                                <h4 class="widget-title">Timeframe</h4>
                                <div class="divider"></div>

                                <ul class="categories">
                                    <li>
                                        <a href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 0, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 0) class="active" @endif>
                                            All
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 1, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 1) class="active" @endif>
                                            1 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 3, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 3) class="active" @endif>
                                            3 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 6, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 6) class="active" @endif>
                                            6 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('links.list', array_merge(array_filter(request()->query()), ['timeframe' => 12, 'page' => 1])) }}" @if (request('timeframe', settings('links_setup.default_timeframe', 0)) == 12) class="active" @endif>
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

    <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
@endsection
