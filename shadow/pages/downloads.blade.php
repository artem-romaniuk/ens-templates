@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

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
        <div class="container">
            <div class="row">
                @if (isset($categories))

                    @if ($categories->isNotEmpty())
                        @foreach($categories as $category)
                            <div class="col-lg-4 py-4 wow fadeInUp">
                                <div class="card-blog" style="min-width: 100%">
                                    <div class="body">
                                        <h5 class="post-title entry-title">
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
                    @endif
                @endif

                @if (isset($files))
                    <div class="col-lg-8">
                        <div class="row">
                            <h5 class="title my-3">
                                <a href="{{ route('downloads.categories') }}">
                                    {{ $name }}
                                </a>
                                /
                                {{ $category->title ?? $category->name }}
                            </h5>

                            @foreach($files as $file)
                                <div class="col-lg-12 py-4 wow fadeInUp">
                                    <div class="card-blog" style="min-width: 100%">
                                        <div class="body position-relative">
                                            @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
                                                <div style="background: #6C55F9;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
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
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($files->lastPage() > 1)
                            <nav aria-label="Page Navigation">
                                {{ $files->onEachSide(2)->appends(request()->query())->links('vendor.pagination.shadow') }}
                            </nav>
                        @endif
                    </div>

                    <div class="col-lg-4">
                        <div class="widget pt-3">
                            <div class="widget-box">
                                <form action="{{ route('downloads.list', $category->id) }}" class="search-widget" method="get">
                                    <input type="text" name="search" class="form-control" placeholder="Enter keyword.." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                                </form>
                            </div>

                            <div class="widget-box">
                                <h4 class="widget-title">Timeframe</h4>
                                <div class="divider"></div>

                                <ul class="categories">
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
    </div>

    <section class="container py-0 page-content">
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
        </section>
@endsection
