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
                <div class="row g-5 services-list">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        @if (isset($links))
                            <div class="row gy-5 posts-list">
                                @foreach($links as $link)
                                    <div class="col-lg-12">
                                        <article class="d-flex flex-column position-relative pb-2">
                                            <h2 class="title">
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
                                            </h2>

                                            <div class="content">
                                                {!! $link->description !!}
                                            </div>

                                            <div class="sub-title mt-3">
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
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if ($links->lastPage() > 1)
                            <div class="blog-pagination">
                                {{ $links->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="sidebar ps-lg-4">
                            <div class="sidebar-item search-form">
                                <h3 class="sidebar-title">Search</h3>
                                <form action="{{ route('links.list') }}" method="get">
                                    <input type="text" name="search" value="{{ request('search') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>

                            @if (isset($categories) && $categories->isNotEmpty())
                                <div class="sidebar-item categories">
                                    <h3 class="sidebar-title">Categories</h3>
                                    <ul class="mt-3">
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

                            <div class="sidebar-item categories">
                                <h3 class="sidebar-title">Timeframe</h3>
                                <ul class="mt-3">
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
        </section>

        <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
    </main>
@endsection
