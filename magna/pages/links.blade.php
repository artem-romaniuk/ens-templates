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
                <div class="row contact pb-0">
                    @if (isset($links))
                        <div class="col-lg-8 entries">
                            <div class="row contact">
                                @foreach($links as $link)
                                    <div class="col-md-12">
                                        <div class="info-box position-relative px-4 py-4">
                                            <h3 style="text-align: initial">
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
                                            </h3>

                                            <div class="mb-2" style="text-align: initial">
                                                {!! $link->description !!}
                                            </div>

                                            <div class="sub-title" style="text-align: initial">
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
                            </div>

                            @if ($links->lastPage() > 1)
                                <div class="blog-pagination mb-4">
                                    {{ $links->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar">
                                <h3 class="sidebar-title">Search</h3>
                                <div class="sidebar-item search-form">
                                    <form action="{{ route('links.list') }}" method="get">
                                        <input type="text" name="search" value="{{ request('search') }}">
                                        <button type="submit"><i class="bi bi-search"></i></button>
                                    </form>
                                </div>

                                @if (isset($categories) && $categories->isNotEmpty())
                                    <h3 class="sidebar-title">Categories</h3>
                                    <div class="sidebar-item categories">
                                        <ul>
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

                                <h3 class="sidebar-title">Timeframe</h3>
                                <div class="sidebar-item categories">
                                    <ul>
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
                    @endif
                </div>
            </div>
        </section>

       <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection
