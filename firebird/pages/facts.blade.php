@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <div class="hero_area sticky-top">
        @includeIf('themes.' . current_theme() . '.layouts.includes.header')
    </div>

    @if (! empty($data['banner']))
        @php($banner = $data['banner'][0])
        <section class="d-flex justify-content-center flex-column align-items-center page-banner" style="background-image: url('{{ $banner['image']['url'] ?? '' }}'); min-height: 90px; max-height: 300px; background-size: cover; @if($banner['image']['url']) height: 300px @endif">
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

    <section class="py-4 blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 entries">
                    @if (! empty($facts))
                        @foreach($facts as $fact)
                            <section class="service_section mb-4">
                                <div class="service_container mx-0 pt-3 pb-3">
                                    <article class="entry box mt-0">
                                        <div class="detail-box">
                                            <h5 class="entry-title">
                                                {{ $fact->title ?? $fact->name }}
                                            </h5>

                                            <div class="description">{!! $fact->text !!}</div>
                                        </div>
                                    </article>
                                </div>
                            </section>
                        @endforeach

                        @if ($facts->lastPage() > 1)
                            <div class="blog-pagination mb-4">
                                {{ $facts->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                            </div>
                        @endif
                    @endif
                </div>

                <div class="col-lg-4 entries sidebar">
                    <section class="service_section mb-4">
                        <div class="service_container mx-0 py-3">
                            <div class="sidebar-item search-form">
                                <form action="{{ route('facts.list') }}" class="d-flex" method="get">
                                    <input type="text" placeholder="Search" class="mb-0" name="search" value="{{ request('search') }}">
                                    <button class="cta-btn mt-0 ml-2" type="submit">Go</button>
                                </form>
                            </div>
                        </div>
                    </section>

                    @if (isset($categories) && $categories->isNotEmpty())
                        <section class="service_section mb-4">
                            <div class="service_container mx-0 py-3">
                                    <h5 class="sidebar-title">Categories</h5>
                                    <div class="sidebar-item categories box mt-4">
                                        <ul class="detail-box px-2 mt-0">
                                            <li>
                                                <a href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                    All categories
                                                </a>
                                            </li>
                                            @foreach($categories as $category)
                                                <li>
                                                    <a href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'page' => 1])) }}" @if (request('category') == $category->id) class="active" @endif>
                                                        {{ $category->name }} <span>({{ $category->facts_count }})</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                            </div>
                        </section>
                    @endif

                    <section class="service_section mb-4">
                        <div class="service_container mx-0 py-3">
                            <h5 class="sidebar-title">Timeframe</h5>
                            <div class="sidebar-item categories box mt-4">
                                <ul class="detail-box px-2 mt-0">
                                    <li>
                                        <a href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 0, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 0) class="active" @endif>
                                            All
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 1, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 1) class="active" @endif>
                                            1 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 3, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 3) class="active" @endif>
                                            3 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 6, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 6) class="active" @endif>
                                            6 month
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 12, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 12) class="active" @endif>
                                            12 month
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

   <section class="container py-0">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
@endsection
