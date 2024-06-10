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
            <div class="section page-header-area" @if (! empty($banner['image']['url'])) data-bg-img="'{{ $banner['image']['url'] }}'" @endif>
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-auto text-center text-sm-start">
                            <h1 class="page-header-title" style="@if (! empty($banner['title']['color'])) color: {{ $banner['title']['color'] }}; @endif @if (! empty($banner['title']['font_size'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">{{ $banner['title']['text'] ?? '' }}</h1>
                            @if (! empty($banner['subtitle']['text']))
                                <p class="link-nav" style="@if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">{{ $banner['subtitle']['text'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (isset($categories))
            @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])

            @if ($categories->isNotEmpty())
                <div class="event-section section section-padding pb-0 pt-6">
                    <div class="container">
                        <div class="row justify-content-between flex-xl-row-reverse">
                            <div class="col-lg-12 col-xl-12 d-flex flex-wrap">
                                @foreach($categories as $category)
                                    <div class="col-4 px-3 py-3">
                                        <div class="event-item flex-md-nowrap flex-sm-wrap">
                                            <div class="content p-5">
                                                <div class="details" style="width: 100%">
                                                    <h4 class="title text-center mb-0">
                                                        <a href="{{ route('downloads.list', $category->id) }}">
                                                            {{ $category->title ?? $category->name }}
                                                        </a>
                                                    </h4>

                                                    @if (! empty($category->description))
                                                        <div>
                                                            {!! $category->description !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @if (isset($files))
            <div class="event-section section section-padding pb-0">
                <div class="container">
                    <div class="row justify-content-between flex-xl-row-reverse">
                        <div class="col-lg-12 col-xl-8">
                            <h4 class="title my-3">
                                <a href="{{ route('downloads.categories') }}">
                                    {{ $name }}
                                </a>
                                /
                                {{ $category->title ?? $category->name }}
                            </h4>

                            @foreach($files as $file)
                                <div class="col-12 mb-6">
                                    <div class="event-item flex-md-nowrap flex-sm-wrap">
                                        <div class="content p-5" style="position: relative">
                                            <div class="details" style="width: 100%">
                                                @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
                                                    <div style="background: #cb914f;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
                                                @endif

                                                <h4 class="title">
                                                    <a href="{{ $file->getFirstMediaUrl('downloads') }}" download="">
                                                        {{ $file->title ?? $file->name }}
                                                    </a>
                                                </h4>

                                                <div>
                                                    {!! $file->description !!}
                                                </div>

                                                @if (settings('files_setup.display_last_updated_date', false))
                                                    <div class="sub-title mt-3">
                                                        Updated: {{ $file->updated_at?->format('F d, Y') ?? '' }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if ($files->lastPage() > 1)
                                <div class="col-12">
                                    <div class="mt-6 mt-md-10">
                                        {{ $files->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-12 col-xl-4">
                            <div class="sidebar-wrap mt-8 mt-xl-0 pe-0 pe-xl-6">
                                <div class="sidebar-search-widget">
                                    <form action="{{ route('downloads.list', $category->id) }}" method="get">
                                        <input class="form-control search-input" name="search" type="search" placeholder="Search here" value="{{ request('search') }}">
                                        @foreach(array_filter(request()->query() ?? []) as $name => $value)
                                            @continue($name == 'search')
                                            <input name="{{ $name }}" type="hidden" value="{{ $value }}">
                                        @endforeach
                                        <button type="submit"><i class="icofont-search-1"></i></button>
                                    </form>
                                </div>

                                <div class="sidebar-widget">
                                    <h3 class="sidebar-widget-title">Timeframe</h3>
                                    <div class="sidebar-widget-body">
                                        <ul class="sidebar-category-list">
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
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
