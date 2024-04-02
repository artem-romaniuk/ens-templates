@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <div class="hero_area">
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

    <section class="pb-4 blog">
        <div class="container">
            <div class="row">
                @if (isset($categories))
                    <div class="col-lg-12 entries">
                        @if ($categories->isNotEmpty())
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-lg-4 service_section mt-3">
                                        <div class="box mt-0 mb-2 service_container pt-4 pb-4" style="margin: 0">
                                            <div class="detail-box mt-0">
                                                <h5 class="entry-title mb-0">
                                                    <a href="{{ route('downloads.list', $category->id) }}" class="stretched-link">{{ $category->title ?? $category->name }}</a>
                                                </h5>

                                                @if (! empty($category->description))
                                                    <div class="post-short-description">
                                                        {!! $category->description !!}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                @if (isset($files))
                    <div class="col-lg-8 entries">
                        <h5 class="title my-3">
                            <a href="{{ route('downloads.categories') }}">
                                {{ $name }}
                            </a>
                            /
                            {{ $category->title ?? $category->name }}
                        </h5>

                        @if (! empty($files))
                            @foreach($files as $file)
                                <section class="service_section mb-4">
                                    <div class="service_container mx-0 pt-3 pb-3">
                                        <article class="entry box mt-0">
                                            @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
                                                <div style="background: #f07b26;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
                                            @endif

                                            <div class="detail-box mt-1">
                                                <h5 class="entry-title">
                                                    <a href="{{ $file->getFirstMediaUrl('downloads') }}" target="_blank">{{ $file->title ?? $file->name }}</a>
                                                </h5>

                                                <div class="sub-title mb-2">
                                                    @if (! empty($file->description))
                                                        {!! $file->description !!}
                                                    @endif
                                                </div>

                                                @if (settings('files_setup.display_last_updated_date', false))
                                                    <div class="read-more mt-auto align-self-end" style="font-size: 0.8em">
                                                        Updated: {{ $file->updated_at?->format('F d, Y') ?? '' }}
                                                    </div>
                                                @endif
                                            </div>
                                        </article>
                                    </div>
                                </section>
                            @endforeach

                            @if ($files->lastPage() > 1)
                                <div class="blog-pagination mb-4">
                                    {{ $files->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="col-lg-4 entries sidebar">
                        <section class="service_section mb-4">
                            <div class="service_container mx-0 py-3">
                                <div class="sidebar-item search-form">
                                    <form action="{{ route('downloads.list', $category->id) }}" class="d-flex" method="get">
                                        <input type="text" placeholder="Search" class="mb-0" name="search" value="{{ request('search') }}">
                                        <button class="cta-btn mt-0 ml-2" type="submit">Go</button>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <section class="service_section mb-4">
                            <div class="service_container mx-0 py-3">
                                <h5 class="sidebar-title">Timeframe</h5>
                                <div class="sidebar-item categories box mt-4">
                                    <ul class="detail-box px-2 mt-0">
                                        <li>
                                            <a href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 0, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 0) class="active" @endif>
                                                All
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 1, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 1) class="active" @endif>
                                                1 month
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 3, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 3) class="active" @endif>
                                                3 month
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 6, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 6) class="active" @endif>
                                                6 month
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 12, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 12) class="active" @endif>
                                                12 month
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="container py-0">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
@endsection
