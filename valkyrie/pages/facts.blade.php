@extends('themes.' . current_theme() . '.layouts.main')

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
                        <div class="col-lg-3">
                            <div class="sidebar mb-4">
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <form action="{{ route('facts.list') }}" class="contact-form" method="get">
                                            <fieldset>
                                                <input type="text" name="search" class="form-control mb-2" placeholder="Enter keyword.." value="{{ request('search') }}">
                                            </fieldset>
                                            <button type="submit" class="btn btn-success" style="width: 100%; height: 38px; line-height: 8px">Search</button>
                                        </form>
                                    </div>

                                    @if (isset($categories) && $categories->isNotEmpty())
                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="h2 mb-2">Category</h6>
                                                <ul class="list-unstyled pl-3">
                                                    <li class="mb-1">
                                                        <a class="text-decoration-none" href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['category' => '', 'page' => 1])) }}" @if (!request('category')) class="active" @endif>
                                                            All categories
                                                        </a>
                                                    </li>
                                                    @foreach($categories as $category)
                                                        <li class="mb-1">
                                                            <a class="text-decoration-none" href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['category' => $category->id, 'page' => 1])) }}" @if (request('category') == $category->id) class="active" @endif>
                                                                {{ $category->name }} <span>({{ $category->facts_count }})</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-lg-12">
                                        <div class="category">
                                            <h6 class="h2 mb-2">Timeframe</h6>
                                            <ul class="list-unstyled pl-3">
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 0, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 0) class="active" @endif>
                                                        All
                                                    </a>
                                                </li>
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 1, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 1) class="active" @endif>
                                                        1 month
                                                    </a>
                                                </li>
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 3, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 3) class="active" @endif>
                                                        3 month
                                                    </a>
                                                </li>
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 6, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 6) class="active" @endif>
                                                        6 month
                                                    </a>
                                                </li>
                                                <li class="mb-1">
                                                    <a class="text-decoration-none" href="{{ route('facts.list', array_merge(array_filter(request()->query()), ['timeframe' => 12, 'page' => 1])) }}" @if (request('timeframe', settings('facts_setup.default_timeframe', 0)) == 12) class="active" @endif>
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
                            @if (! empty($facts))
                                <div class="row">
                                    @foreach($facts as $fact)
                                        <div class="col-12 col-md-12 mb-12 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h5 class="entry-title">
                                                        {{ $fact->title ?? $fact->name }}
                                                    </h5>

                                                    <div class="description">{!! $fact->text !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    @if ($facts->lastPage() > 1)
                                        {{ $facts->onEachSide(2)->appends(request()->query())->links('vendor.pagination.valkyrie') }}
                                    @endif
                                </div>
                            @endif
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
