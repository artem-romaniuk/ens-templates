@extends('themes.' . current_theme() . '.layouts.main')

@section('body_class', 'sub_page')

@section('content')
    <section class="bg-success py-5" style="background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); background-size: cover;">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row align-items-center py-5">
                <div class="col-md-12 text-white">
                    <h1 style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h1>

                    @if (! empty($banner['subtitle']['text']))
                        <h3 style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </h3>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="shows-events-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tabs-content mt-4">
                    <div class="row">
                        @if (isset($categories))
                            <div class="col-lg-12 tickets-page mb-2">

                                @if ($categories->isNotEmpty())
                                    <div class="row">
                                        @foreach($categories as $category)
                                            <div class="col-lg-4 ticket-item pb-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="post-title entry-title">
                                                            <a href="{{ route('downloads.list', $category->id) }}" class="undecoration-link">{{ $category->title ?? $category->name }}</a>
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
                            <div class="col-lg-3">
                                <div class="sidebar mb-4">
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <form action="{{ route('downloads.list', $category->id) }}" class="contact-form" method="get">
                                                <fieldset>
                                                    <input type="text" name="search" class="form-control mb-2" placeholder="Enter keyword.." value="{{ request('search') }}">
                                                </fieldset>
                                                <button type="submit" class="btn btn-success" style="width: 100%; height: 38px; line-height: 8px">Search</button>
                                            </form>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="h2 mb-2">Timeframe</h6>
                                                <ul class="list-unstyled pl-3">
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 0, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 0) class="active" @endif>
                                                            All
                                                        </a>
                                                    </li>
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 1, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 1) class="active" @endif>
                                                            1 month
                                                        </a>
                                                    </li>
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 3, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 3) class="active" @endif>
                                                            3 month
                                                        </a>
                                                    </li>
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 6, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 6) class="active" @endif>
                                                            6 month
                                                        </a>
                                                    </li>
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('downloads.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'timeframe' => 12, 'page' => 1])) }}" @if (request('timeframe', settings('files_setup.default_timeframe', 0)) == 12) class="active" @endif>
                                                            12 month
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                @if (! empty($files))
                                    <div class="row">
                                        <h5 class="title mb-3 mt-1 mx-0">
                                            <a class="undecoration-link" href="{{ route('downloads.categories') }}">
                                                {{ $name }}
                                            </a>
                                            /
                                            {{ $category->title ?? $category->name }}
                                        </h5>
                                        @foreach($files as $file)
                                            <div class="col-lg-12 ticket-item mb-3">
                                                <div class="card down-content position-relative" style="min-width: 100%">
                                                    <div class="card-body">
                                                        @if ($file->created_at > now()->subDays(settings('files_setup.days_marked_as_new', 0)))
                                                            <div style="background: #59ab6e;width: fit-content;padding: 2px 15px;color:#ffffff;position: absolute;top: 0;right: 0; font-size: 0.9em">New</div>
                                                        @endif

                                                        <div class="detail-box mt-1">
                                                            <h5 class="entry-title">
                                                                <a style="text-decoration: underline; color: #000;" href="{{ $file->getFirstMediaUrl('downloads') }}" target="_blank">{{ $file->title ?? $file->name }}</a>
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

                                    <div class="row">
                                        @if ($files->lastPage() > 1)
                                            {{ $files->onEachSide(2)->appends(request()->query())->links('vendor.pagination.valkyrie') }}
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container py-0 page-content">
        @includeif('themes.' . current_theme() . '.layouts.includes.content', ['content' => $data['content'] ?? ''])
    </section>
@endsection
