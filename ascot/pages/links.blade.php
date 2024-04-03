@extends('themes.' . current_theme() . '.layouts.main')

@section('content')
    <div class="page-heading-rent-venue" 
            style="
            background-image: url('{{ $data['banner'][0]['image']['url'] ?? '' }}'); 
            background-size: cover;
            @if (empty($data['banner'][0]['image']['url'])) padding: 20px 0px !important; @endif">
        <div class="container">
            @if (! empty($data['banner']))
                @php($banner = $data['banner'][0])
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center" 
                        style="
                            @if (! empty($banner['title']['color']) && ! empty($banner['title']['text'])) color: {{ $banner['title']['color'] }} !important; @endif
                            @if (! empty($banner['title']['font_size']) && ! empty($banner['title']['text'])) font-size: {{ $banner['title']['font_size'] }}px; @endif">
                        {{ ! empty($banner['title']['text']) ? $banner['title']['text'] : null ?? ($data['banner'][0]['image']['url'] ? null : $title) ?? ($data['banner'][0]['image']['url'] ? null : $name) ?? '' }}
                    </h2>

                    @if (! empty($banner['subtitle']['text']))
                        <span style="
                                @if (! empty($banner['subtitle']['color'])) color: {{ $banner['subtitle']['color'] }}; @endif
                                @if (! empty($banner['subtitle']['font_size'])) font-size: {{ $banner['subtitle']['font_size'] }}px; @endif">
                            {{ $banner['subtitle']['text'] }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="shows-events-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 tabs-content mt-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="sidebar mb-4">
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <form action="{{ route('links.list') }}" class="contact-form" method="get">
                                            <fieldset>
                                                <input type="text" name="search" class="mb-1" placeholder="Enter keyword.." value="{{ request('search') }}">
                                            </fieldset>
                                            <button type="submit" class="button" style="width: 100%; height: 38px; line-height: 8px">Search</button>
                                        </form>
                                    </div>

                                    @if (isset($categories) && $categories->isNotEmpty())
                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="mb-2">Category</h6>
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
                                        </div>
                                    @endif

                                    <div class="widget-box">
                                        <div class="col-lg-12">
                                            <div class="category">
                                                <h6 class="mb-2">Timeframe</h6>

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
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            @if (! empty($links))
                                <div class="row tickets-page mb-0">
                                    @foreach($links as $link)
                                        <div class="col-lg-12 mb-2 ticket-item">
                                            <div class="down-content" style="min-width: 100%">
                                                <div class="body">
                                                    <h5 class="post-title entry-title">
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
                                                    </h5>

                                                    <div class="description my-2">{!! $link->description !!}</div>

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

                                    @if ($links->lastPage() > 1)
                                        <div class="col-lg-12">
                                            <div class="pagination mt-2 mb-4">
                                                {{ $links->onEachSide(2)->appends(request()->query())->links('vendor.pagination.ascot') }}
                                            </div>
                                        </div>
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
