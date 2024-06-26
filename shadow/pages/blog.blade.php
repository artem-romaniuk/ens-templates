@extends('themes.' . current_theme() . '.layouts.main')

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
                <div class="col-lg-8">
                    <div class="row">
                        @if (! empty($posts))
                            @foreach($posts as $post)
                                @includeIf('themes.' . current_theme() . '.blocks.post', ['post' => $post, 'class' => 'col-lg-6'])
                            @endforeach
                        @endif
                    </div>

                    @if ($posts->lastPage() > 1)
                        <nav aria-label="Page Navigation">
                            {{ $posts->onEachSide(2)->appends(request()->query())->links('vendor.pagination.shadow') }}
                        </nav>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="widget pt-3">
                        <div class="widget-box">
                            <form action="{{ route('pages.single', 'blog') }}" class="search-widget" method="get">
                                <input type="text" name="search" class="form-control" placeholder="Enter keyword.." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </form>
                        </div>

                        @if (isset($categories) && $categories->isNotEmpty())
                            <div class="widget-box">
                                <h4 class="widget-title">Category</h4>
                                <div class="divider"></div>

                                <ul class="categories">
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('pages.single', array_merge(array_filter(request()->query()), ['slug' => 'blog', 'category' => $category->id, 'page' => 1])) }}">{{ $category->name }} <span>({{ $category->posts_count }})</span></a>
                                        </li>
                                    @endforeach
                                </ul>
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
