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
                    @if (isset($categories))

                        @if ($categories->isNotEmpty())
                            @foreach($categories as $category)
                                <div class="col-md-4">
                                    <a href="{{ route('downloads.list', $category->id) }}" class="info-box d-block">
                                        <h3>{{ $category->title ?? $category->name }}</h3>
                                        @if (! empty($category->description))
                                            <p>
                                                {!! $category->description !!}
                                            </p>
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    @endif

                    @if (isset($files))
                        <div class="col-lg-8 entries">
                            <div class="row contact">
                                <h5 class="title my-3">
                                    <a href="{{ route('downloads.categories') }}">
                                        {{ $name }}
                                    </a>
                                    /
                                    {{ $category->title ?? $category->name }}
                                </h5>

                                @foreach($files as $file)
                                    <div class="col-md-12">
                                        <div class="info-box position-relative px-4 py-4">
                                            @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
                                                <div style="background: #68A4C4;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
                                            @endif

                                            <a href="{{ $file->getFirstMediaUrl('downloads') }}" download="">
                                                <h3 style="text-align: initial">{{ $file->title ?? $file->name }}</h3>
                                            </a>

                                            @if (! empty($file->description))
                                                <div style="text-align: initial">
                                                    {!! $file->description !!}
                                                </div>
                                            @endif

                                            @if (settings('files_setup.display_last_updated_date', false))
                                                <div class="sub-title mt-3" style="text-align: initial">
                                                    Updated: {{ $file->updated_at?->format('F d, Y') ?? '' }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if ($files->lastPage() > 1)
                                <div class="blog-pagination mb-4">
                                    {{ $files->onEachSide(2)->appends(request()->query())->links('vendor.pagination.moderna') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar">
                                <h3 class="sidebar-title">Search</h3>
                                <div class="sidebar-item search-form">
                                    <form action="{{ route('downloads.list', $category->id) }}" method="get">
                                        <input type="text" name="search" value="{{ request('search') }}">
                                        <button type="submit"><i class="bi bi-search"></i></button>
                                    </form>
                                </div>

                                <h3 class="sidebar-title">Timeframe</h3>
                                <div class="sidebar-item categories">
                                    <ul>
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
