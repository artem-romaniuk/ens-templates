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
                    @if (isset($categories))
                        @if ($categories->isNotEmpty())
                            @foreach($categories as $category)
                                <div class="col-lg-4 col-md-6 service-item d-flex aos-init aos-animate service-item" data-aos="fade-up" data-aos-delay="100">
                                    <div>
                                        <h4 class="title"><a href="{{ route('downloads.list', $category->id) }}" class="stretched-link">{{ $category->title ?? $category->name }}</a></h4>
                                        @if (! empty($category->description))
                                            <p class="description">{!! $category->description !!}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif

                    @if (isset($files))
                        <h5 class="title my-3">
                            <a href="{{ route('downloads.categories') }}">
                                {{ $name }}
                            </a>
                            /
                            {{ $category->title ?? $category->name }}
                        </h5>

                        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                            <div class="row gy-5 posts-list">
                                @foreach($files as $file)
                                    <div class="col-lg-12">
                                        <article class="d-flex flex-column position-relative pb-2">
                                            @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
                                                <div style="background: #68A4C4;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
                                            @endif

                                            <h2 class="title">
                                                <a href="{{ $file->getFirstMediaUrl('downloads') }}" target="_blank">{{ $file->title ?? $file->name }}</a>
                                            </h2>

                                            <div class="content pb-2">
                                                @if (! empty($file->description))
                                                    {!! $file->description !!}
                                                @endif
                                            </div>

                                            @if (settings('files_setup.display_last_updated_date', false))
                                                <div class="read-more mt-auto align-self-end" style="font-size: 0.8em">
                                                    Updated: {{ $file->updated_at?->format('F d, Y') ?? '' }}
                                                </div>
                                            @endif
                                        </article>
                                    </div>
                                @endforeach
                            </div>

                            @if ($files->lastPage() > 1)
                                <div class="blog-pagination">
                                    {{ $files->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="sidebar ps-lg-4">
                                <div class="sidebar-item search-form">
                                    <h3 class="sidebar-title">Search</h3>
                                    <form action="{{ route('downloads.list', $category->id) }}" method="get">
                                        <input type="text" name="search" value="{{ request('search') }}">
                                        <button type="submit"><i class="bi bi-search"></i></button>
                                    </form>
                                </div>

                                <div class="sidebar-item categories">
                                    <h3 class="sidebar-title">Timeframe</h3>
                                    <ul class="mt-3">
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
